[![Codeship Status for proyectotau/TAU](https://app.codeship.com/projects/6d92bdb0-0f19-0136-35ef-3ea88bf3cfc8/status?branch=modules&style=plastic)](https://app.codeship.com/projects/282434) ![language PHP](https://img.shields.io/badge/language-PHP-green.svg?longCache=true&style=plastic) ![framework Laravel](https://img.shields.io/badge/framework-Laravel-red.svg?longCache=true&style=plastic) [![SourceForge](https://img.shields.io/sourceforge/dt/tauproject.svg?longCache=true&style=plastic)](https://sourceforge.net/projects/tauproject/) [![SourceForge](https://img.shields.io/sourceforge/dm/tauproject.svg?longCache=true&style=plastic)](https://sourceforge.net/projects/tauproject/) [![GPL license](https://img.shields.io/badge/License-GPL-blue.svg?longCache=true&style=plastic)](http://perso.crans.org/besson/LICENSE.html) ![badges shields.io](https://img.shields.io/badge/badges-shields.io-green.svg?longCache=true&style=plastic)

![TAU logo](http://tauproject.sourceforge.net/images/logo.png)

# TAU
Brand new, enhanced, rewriting of popular 10-years-old legacy application coded in vanilla PHP (without framework), using plain design pattern of MVC. Now migrating to Laravel!!

Visit our primary website for downloading from http://tauproject.sourceforge.net/

We're about to release v1.28

Stay tuned !!!

# TAU be or Not TAU be
TAU is not a Framework. It's an environment where apps run, live and work.

We use Nwidart's Laravel-Modules to modules become into an independent app, because it mimics our legacy modules way of life.

[nWidart/laravel-modules](https://github.com/nWidart/laravel-modules) is a must-have!

# Getting Started

1. git clone --branch "modules" https://github.com/proyectotau/TAU.git
1. mkdir -p ./bootstrap/cache
1. composer install --prefer-dist
1. export MYSQL_USER=root
1. export MYSQL_PASSWORD=secret
1. database/migrations/bd_test/create_database.sh
1. database/migrations/bd_test/create_tables.sh
1. vendor/bin/phpunit