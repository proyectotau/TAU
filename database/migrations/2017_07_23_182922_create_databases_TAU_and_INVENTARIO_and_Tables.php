<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\DB;

include_once 'tauproject/web/config.inc.php';

define('DIR', '/var/www/TAU/database/migrations/bd_test/');

class CreateDatabasesTAUAndINVENTARIOAndTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mysql_cmd = 'mysql --line-numbers -v -v -v -h %s -u %s -p%s';

        for ($i = 0; $i <= 26; $i++){
            echo $this->mysql_cmd_echo($mysql_cmd, $i);
            exec($this->mysql_cmd_exec($mysql_cmd, $i) . ' 2>&1', $salida);
            $this->toConsole($salida);
            $this->dieIfError($salida);
        }

        /*
        echo $this->mysql_cmd_echo($mysql_cmd, 99);
        exec($this->mysql_cmd_exec($mysql_cmd, 99) . ' 2>&1', $salida);
        $this->toConsole($salida);
        $this->dieIfError($salida);
        */

        //$this->createMigration();
    }

    public function down(){
        $tableNames = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();

        foreach ($tableNames as $name) {
            if ($name == 'migrations') {
                continue;
            }
            DB::table($name)->truncate();
        }
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function downOLD()
    {
        $mysql_cmd_drop_databases = 'mysql -h %s -u %s -p%s ' .
            '--execute="
                DROP DATABASE IF EXISTS ' . mb_strtolower(DB_ODBC) . '_test;
                DROP DATABASE IF EXISTS ' . mb_strtolower(Inventario2_DB_ODBC) . '_test"';

        $mysql_cmd_create_databases = 'mysql -h %s -u %s -p%s ' .
            '--execute="
                CREATE DATABASE IF NOT EXISTS ' . mb_strtolower(DB_ODBC) . '_test;
                CREATE DATABASE IF NOT EXISTS ' . mb_strtolower(Inventario2_DB_ODBC) . '_test"';

        echo $this->mysql_cmd_echo($mysql_cmd_drop_databases);
        exec($this->mysql_cmd_exec($mysql_cmd_drop_databases) . ' 2>&1', $salida);
        $this->toConsole($salida);
        $this->dieIfError($salida);

        echo $this->mysql_cmd_echo($mysql_cmd_create_databases);
        exec($this->mysql_cmd_exec($mysql_cmd_create_databases) . ' 2>&1', $salida);
        $this->toConsole($salida);
        $this->dieIfError($salida);

        $this->createMigration();
    }

    private function createMigration(){
        /*
CREATE TABLE migrations
(
    id INT(10) unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
    migration VARCHAR(255) NOT NULL,
    batch INT(11) NOT NULL
);     */

        $mysql_cmd_insert = 'mysql -h %s -u %s -p%s ' .
            '--execute="
            INSERT INTO ' . mb_strtolower(DB_ODBC) . '_test.migrations (
                id, migration, batch
            ) VALUES (
                1, "2017_07_23_182922_create_databases_TAU_and_INVENTARIO_and_Tables", 1
            );
            "';

        Schema::create(mb_strtolower(Inventario2_DB_ODBC) . '_test.migrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('migration', 255);
            $table->integer('batch');
        });

        echo $this->mysql_cmd_echo($mysql_cmd_insert);
        exec($this->mysql_cmd_exec($mysql_cmd_insert) . ' 2>&1', $salida);
        $this->toConsole($salida);
        $this->dieIfError($salida);
    }

    private function mysql_cmd_echo($mysql_cmd, $i = NULL){
        return '-- ' . $this->getSource_TAU_file($i) . PHP_EOL .
            sprintf($mysql_cmd . (is_null($i)?'':' < ' . DIR . $this->getSource_TAU_file($i)) . PHP_EOL,
                DB_SERVER, DB_USER, '***');
    }

    private function mysql_cmd_exec($mysql_cmd, $i = NULL){
        return sprintf($mysql_cmd . (is_null($i)?'':' < ' . DIR . $this->getSource_TAU_file($i)) . PHP_EOL,
                DB_SERVER, DB_USER, DB_PASS);
    }

    private function getSource_TAU_file($i){
        if($i == 0) {
            $tau_file = 'TAUv1.sql';
        } else {
            $tau_file = sprintf('TAUv1.%d.sql', $i);
        }
        return $tau_file;
    }

    private function dieIfError($salida){
        if( in_array('ERROR', $salida) !== false )
            die(1);
    }

    private function toConsole($salida){
        if ($salida) {
            foreach ($salida as $lin) {
                echo $lin . PHP_EOL;
            }
        }
    }
}
