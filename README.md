[![Codeship Status for proyectotau/TAU](https://app.codeship.com/projects/6d92bdb0-0f19-0136-35ef-3ea88bf3cfc8/status?style=plastic)](https://app.codeship.com/projects/282434) ![language PHP](https://img.shields.io/badge/language-PHP-green.svg?longCache=true&style=plastic) ![framework Laravel](https://img.shields.io/badge/framework-Laravel-red.svg?longCache=true&style=plastic) [![SourceForge Total](https://img.shields.io/sourceforge/dt/tauproject.svg?longCache=true&style=plastic)](https://sourceforge.net/projects/tauproject/) [![SourceForge Month](https://img.shields.io/sourceforge/dm/tauproject.svg?longCache=true&style=plastic)](https://sourceforge.net/projects/tauproject/) [![GPL license](https://img.shields.io/badge/License-GPL-blue.svg?longCache=true&style=plastic)](http://perso.crans.org/besson/LICENSE.html) [![badges shields.io](https://img.shields.io/badge/badges-shields.io-green.svg?longCache=true&style=plastic)](https://shields.io)

[![TAU website](http://tauproject.sourceforge.net/images/logo.png)](http://tauproject.sourceforge.net/)

# TAU
Brand new, enhanced, rewriting of popular 10-years-old legacy application coded in vanilla PHP (without framework), using plain design pattern of MVC. Now migrating to Laravel!!

Visit our primary website for downloading from http://tauproject.sourceforge.net/

We're about to release v1.29RC

Stay tuned !!!

# TAU be or Not TAU be
TAU is not a Framework. It's an environment where apps run, live and work.

We use Nwidart's Laravel-Modules to modules become into an independent app, because it mimics our legacy modules way of life.

[nWidart/laravel-modules](https://github.com/nWidart/laravel-modules) is a must-have!

# Getting Started
```sh
 1. git clone --branch "master" https://github.com/proyectotau/TAU.git
 2. mkdir -p ./bootstrap/cache
 3. composer install --prefer-dist
 4. export MYSQL_USER=root
 5. export MYSQL_PASSWORD=secret
# Have a look at database/migrations/bd_test/*
 6. php artisan migrate --force --verbose
 7. vendor/bin/phpunit
 8. cp .env.dusk.local .env
# Workaround bug. See link https://github.com/GoogleChrome/puppeteer/issues/1925#issuecomment-398520641
 9. nohup bash -c "./vendor/laravel/dusk/bin/chromedriver-linux --no-gpu --disable-software-rasterizer --headless --mute-audio --hide-scrollbars --remote-debugging-port=9222 2>&1 &" && sleep 3
10. nohup bash -c "php artisan serve 2>&1 &" && sleep 5
11. php artisan dusk
```