#!/usr/bin/env bash
# Run a command with the dev secrets from OpenBao in its environment (used by `pnpm dev:server`).
#   setup/dev/with-secrets.sh <command> [args...]
# Logs in with the AppRole in ~/.config/openbao/sledgehammertime/{role_id,secret_id}.
set -euo pipefail
export BAO_ADDR="${BAO_ADDR:-https://openbao.went.local}"
creds="${BAO_CREDS_DIR:-${XDG_CONFIG_HOME:-$HOME/.config}/openbao/sledgehammertime}"
BAO_TOKEN="$(bao write -field=token auth/approle/login role_id=@"$creds/role_id" secret_id=@"$creds/secret_id")"
export BAO_TOKEN
secrets="$(bao kv get -format=json -mount=secret sledgehammertime/dev | jq -r '.data.data | to_entries[] | "export \(.key)=\(.value | tostring | @sh)"')"
unset BAO_TOKEN
eval "$secrets"
exec "$@"
