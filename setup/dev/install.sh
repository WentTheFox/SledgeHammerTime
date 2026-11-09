#!/usr/bin/env bash
# Install the local dev systemd units (hammertime-fpm, hammertime-horizon) for THIS machine.
# Fills in the app user, repo path and binary locations, so nothing machine-specific lives in git.
# Usage: setup/dev/install.sh [app-user]   (default: the user running it)
set -euo pipefail
cd "$(dirname "$0")"
USER_NAME="${1:-${SUDO_USER:-$USER}}"
REPO="$(cd ../.. && pwd)"
find_bin() { command -v "$1" 2>/dev/null || true; }
PHP_FPM="$(find_bin php-fpm8.5)"; PHP_FPM="${PHP_FPM:-$(find_bin php-fpm)}"
PHP="$(find_bin php)"
RUN="$(find_bin git-deploy-run)"
for p in /usr/local/lib/git-deploy/git-deploy-run /usr/local/bin/git-deploy-run; do [[ -z "$RUN" && -x $p ]] && RUN=$p; done
for v in PHP_FPM PHP RUN; do [[ -n "${!v}" ]] || { echo "install.sh: could not find $v" >&2; exit 1; }; done
for u in hammertime-fpm hammertime-horizon; do
  sed -e "s#@USER@#$USER_NAME#g" -e "s#@REPO@#$REPO#g" -e "s#@FPM_CONF@#$REPO/setup/dev/php-fpm.conf#g" \
      -e "s#@PHP_FPM@#$PHP_FPM#g" -e "s#@PHP@#$PHP#g" -e "s#@GIT_DEPLOY_RUN@#$RUN#g" "$u.service" \
    | sudo tee "/etc/systemd/system/$u.service" >/dev/null
done
sudo systemctl daemon-reload
echo "Installed for user $USER_NAME at $REPO (units are not enabled, git-deploy-dev starts them on demand)."
echo "Needs /etc/infisical/identities/hammertime.env (root:root 0400) and the nginx vhost fastcgi_pass at /run/hammertime-fpm/fpm.sock."
