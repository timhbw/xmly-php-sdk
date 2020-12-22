#! /usr/bin/env bash

./vendor/bin/phpcbf --standard=PSR2 src
./vendor/bin/phpcbf --standard=PSR2 examples
./vendor/bin/phpcbf --standard=PSR2 tests

./vendor/bin/phpcs --standard=PSR2 src
./vendor/bin/phpcs --standard=PSR2 examples
./vendor/bin/phpcs --standard=PSR2 tests