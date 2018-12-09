set DB_CMD=mysql
set DB_SERVER=%MYSQL_HOST%
set DB_USER=%MYSQL_USER%
set DB_PASS=%MYSQL_PASSWORD%
REM set DB_DATABASE=

if "%DB_SERVER%"=="" set DB_SERVER=localhost
if "%DB_USER%"=="" set DB_USER=root
if "%DB_PASS%"=="" set DB_PASS=test

%DB_CMD% --line-numbers -v -v -v -h %DB_SERVER% -u %DB_USER% -p%DB_PASS% -e "create database tau_test;"
%DB_CMD% --line-numbers -v -v -v -h %DB_SERVER% -u %DB_USER% -p%DB_PASS% -e "create database inventario_test;"