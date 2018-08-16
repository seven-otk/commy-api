#!/bin/bash

set -ev

composer install --no-interaction --no-ansi --optimize-autoloader --ignore-platform-reqs

phpunit

exit 0;