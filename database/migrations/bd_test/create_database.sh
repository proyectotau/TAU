#!/usr/bin/env bash

DB_CMD=mysql
DB_SERVER="${MYSQL_HOST:-localhost}"
DB_USER="${MYSQL_USER:-root}"
DB_PASS="${MYSQL_PASSWORD:-test}"
# set DB_DATABASE=

$DB_CMD --line-numbers -v -v -v -h $DB_SERVER -u $DB_USER -p${DB_PASS} -e 'create database tau_test;'
$DB_CMD --line-numbers -v -v -v -h $DB_SERVER -u $DB_USER -p${DB_PASS} -e 'create database inventario_test;'