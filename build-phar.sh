#! /usr/bin/env bash

# Remove dev deps to reduce phar size
rm -rf composer.lock vendor/

# Generate composer.lock
composer install --no-dev

# Find SDK version
version=$(grep 'const SDK_VER' src/Xmly/Config.php | grep -oE '[0-9.]+')

# Build phar
phar-composer build . xmly-php-sdk-$version.phar