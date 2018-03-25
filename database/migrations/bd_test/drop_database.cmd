set DB_CMD=mysql
set DB_SERVER=localhost
set DB_USER=root
set DB_PASS=%MYSQL_PASSWORD%

%DB_CMD% --line-numbers -v -v -v -h %DB_SERVER% -u %DB_USER% -p%DB_PASS% -e 'drop database tau_test;'
%DB_CMD% --line-numbers -v -v -v -h %DB_SERVER% -u %DB_USER% -p%DB_PASS% -e 'drop database inventario_test;'