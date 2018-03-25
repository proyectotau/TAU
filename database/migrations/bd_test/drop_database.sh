#!/usr/bin/env bash

DB_CMD=mysql
DB_SERVER=${MYSQL_HOST:-localhost}"
DB_USER="${MYSQL_USER:-root}"
DB_PASS="${MYSQL_PASSWORD:-test}"

$DB_CMD --line-numbers -v -v -v -h $DB_SERVER -u $DB_USER -p${DB_PASS} -e 'drop database tau_test;'
$DB_CMD --line-numbers -v -v -v -h $DB_SERVER -u $DB_USER -p${DB_PASS} -e 'drop database inventario_test;'