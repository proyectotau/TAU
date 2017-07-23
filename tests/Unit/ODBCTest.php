<?php

namespace Tests\Unit;

use Tests\TestCase;

include_once '/var/www/TAU/tauproject/web/config.inc.php'; // TODO: short tag for long tag!

class ODBCTest extends TestCase
{
    /*
     * @ignore
     */
    function test_unixODBC_is_available()
    {
       $this->assertNotFalse( $conn = odbc_connect(DB_ODBC, DB_USER, DB_PASS), 'unixODBC is not available');
       odbc_close($conn);

    }

    function test_ODBC_TAU_connection_is_available()
    {
        $this->assertNotFalse( $conn = odbc_connect(DB_ODBC, DB_USER, DB_PASS), 'ODBC TAU is not available');
        odbc_close($conn);
    }

    function test_ODBC_INVENTARIO_connection_is_available()
    {
        $this->assertNotFalse( $conn = odbc_connect(Inventario2_DB_ODBC, DB_USER, DB_PASS), 'ODBC TAU is not available');
        odbc_close($conn);
    }
}