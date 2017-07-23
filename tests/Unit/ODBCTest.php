<?php

namespace Tests\Unit;

use Tests\TestCase;
//use Illuminate\Support\Facades\DB;
//use TCK\Odbc;

//include_once '/var/www/TAU/tauproject/web/config.inc.php';
define("DB_USER", "root");
define("DB_PASS", "vermysql");
define("DB_ODBC", "TAU");
define("Inventario2_DB_ODBC","INVENTARIO");

class ODBCTest extends TestCase
{
    /*
     * @ignore
     */
    function test_TCKODBC_is_available()
    {
        //$users = User::on('odbc')->all();

        /*var_dump($users);
        $c = new ODBCConnector();
        $c->co*/
    }

    /*
     * @ignore
     */
    function test_unixODBC_is_available()
    {
       $this->assertNotFalse( odbc_connect(DB_ODBC, DB_USER, DB_PASS), 'unixODBC is not available');
    }

    function test_ODBC_TAU_connection_is_available()
    {
        $this->assertNotFalse( odbc_connect(DB_ODBC, DB_USER, DB_PASS), 'ODBC TAU is not available');
    }

    function test_ODBC_INVENTARIO_connection_is_available()
    {
        $this->assertNotFalse( odbc_connect(Inventario2_DB_ODBC, DB_USER, DB_PASS), 'ODBC TAU is not available');
    }
}