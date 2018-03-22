<?php

namespace Tests\Unit;

use Tests\TestCase;

include_once 'tauproject/web/config.inc.php';

class ODBCTest extends TestCase
{
    protected function setUp()
    {
        if (!extension_loaded('odbc')) {
            $this->markTestSkipped(
                'The ODBC extension is not available.'
            );
        }
    }

    function test_unixODBC_is_available()
    {
       $this->assertNotFalse( $conn = odbc_connect(DB_ODBC, DB_USER, DB_PASS), 'unixODBC is not available');
       odbc_close($conn);

    }

    /**
    * @depends test_unixODBC_is_available
    */
    function test_ODBC_TAU_connection_is_available()
    {
        $this->assertNotFalse( $conn = odbc_connect(DB_ODBC, DB_USER, DB_PASS), 'ODBC TAU is not available');
        odbc_close($conn);
    }

    /**
    * @depends test_unixODBC_is_available
    */
    function test_ODBC_INVENTARIO_connection_is_available()
    {
        $this->assertNotFalse( $conn = odbc_connect(Inventario2_DB_ODBC, DB_USER, DB_PASS), 'ODBC TAU is not available');
        odbc_close($conn);
    }
}
