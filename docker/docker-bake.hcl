# Builds the three images (fpm, web, ssr) from the repository root:
#   docker buildx bake -f docker/docker-bake.hcl --set '*.platform=linux/arm64'
#   REGISTRY=ghcr.io/wentthefox TAGS=abc1234,latest docker buildx bake -f docker/docker-bake.hcl --push
variable "REGISTRY" { default = "localhost:5000" }
variable "TAGS" { default = "dev" }
variable "GIT_COMMIT_HASH" { default = "unknown" }
variable "GIT_COMMIT_DATE" { default = "unknown" }

group "default" { targets = ["fpm", "web", "ssr"] }

target "_common" {
  context    = "."
  dockerfile = "docker/Dockerfile"
  platforms  = ["linux/amd64", "linux/arm64"]
  args = {
    GIT_COMMIT_HASH = GIT_COMMIT_HASH
    GIT_COMMIT_DATE = GIT_COMMIT_DATE
  }
}

target "fpm" {
  inherits = ["_common"]
  target   = "fpm"
  tags     = [for t in split(",", TAGS) : "${REGISTRY}/sledgehammertime-fpm:${t}"]
}
target "web" {
  inherits = ["_common"]
  target   = "web"
  tags     = [for t in split(",", TAGS) : "${REGISTRY}/sledgehammertime-web:${t}"]
}
target "ssr" {
  inherits = ["_common"]
  target   = "ssr"
  tags     = [for t in split(",", TAGS) : "${REGISTRY}/sledgehammertime-ssr:${t}"]
}
