<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DetectRepeatedQueries;

    /**
     * @param $table
     * @param null $connection
     * @link https://styde.net/metodos-personalizados-para-pruebas-automatizadas-a-la-base-de-datos-con-laravel/
     */
    protected function assertDatabaseEmpty($table, $connection = null)
    {
        $this->assertDatabaseCountExpected($table, 0, null, $connection);
    }

    protected function assertDatabaseCountExpected($table, $countExpected, array $data = null, $connection = null)
    {
        if( $data == null ) {
            $total = $this->getConnection($connection)->table($table)->count();
        } else {
            $total = $this->getConnection($connection)->table($table)->where($data)->count();
        }

        $this->assertSame($countExpected, $total, sprintf(
            "Failed asserting the table [%s] has %s %s. %s %s found.", $table,
                $countExpected, str_plural('row', $countExpected),
                $total,         str_plural('row', $total)
        ));
    }
}
