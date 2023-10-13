# Give write permissions to storage folder.
chmod o+w storage/logs
chmod o+w storage/framework/cache
chmod o+w storage/framework/views

# Docker related aliases
alias dk='docker'
alias dc='docker-compose'
alias up='dc up -d'
alias stop='dc stop'

# Workaround for Windows environment.
if command -v winpty &> /dev/null; then
  alias dk='winpty docker'
  alias dc='winpty docker-compose'
fi

# Node.js related aliases.
alias node-dk='dk run --rm -it -u $UID:$GID -v /tmp/npm:/.npm -v "$PWD":/app -w /app node:18-alpine'
alias node='node-dk node'
alias yarn='node-dk yarn'
alias npm='node-dk npm'

# PHP related aliases.
alias composer='dc exec -u $UID:$GID -e COMPOSER_HOME=/tmp/composer-cache web composer'
alias php='dc exec -u $UID:$GID web php'
alias phpcs='dc exec -u $UID:$GID web vendor/bin/phpcs --cache=./.phpcs.cache'
alias phpcbf='dc exec -u $UID:$GID web vendor/bin/phpcbf'
alias php-cs-fixer='dc exec -u $UID:$GID web vendor/bin/php-cs-fixer'
alias artisan='php artisan'
