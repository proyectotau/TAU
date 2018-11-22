set DB_CMD=mysql
set DB_SERVER=%MYSQL_HOST%
set DB_USER=%MYSQL_USER%
set DB_PASS=%MYSQL_PASSWORD%
REM set DB_DATABASE=

%DB_CMD% --line-numbers -v -v -v -h %DB_SERVER% -u %DB_USER% -p%DB_PASS% -e 'drop database IF EXISTS tau_test;'
%DB_CMD% --line-numbers -v -v -v -h %DB_SERVER% -u %DB_USER% -p%DB_PASS% -e 'drop database IF EXISTS inventario_test;'