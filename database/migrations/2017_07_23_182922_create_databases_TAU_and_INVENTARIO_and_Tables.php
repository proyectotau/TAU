<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\DB;

include_once 'tauproject/web/config.inc.php';

if( !defined('DIR') )
    define('DIR', 'C:/Users/Usuario/GitHub/proyectotau/TAU/database/migrations/bd_test/');

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
            exec($this->mysql_cmd_exec($mysql_cmd, $i) . ' 2>&1', $output);
            $this->toConsole($output);
            $this->dieIfError($output);
        }

        /*
        echo $this->mysql_cmd_echo($mysql_cmd, 99);
        exec($this->mysql_cmd_exec($mysql_cmd, 99) . ' 2>&1', $output);
        $this->toConsole($output);
        $this->dieIfError($output);
        */
    }

    public function down(){
/*
        $mysql_cmd = "mysql -e 'drop database IF EXISTS `tau_test`'";

        echo $this->mysql_cmd_echo($mysql_cmd);
            exec($this->mysql_cmd_exec($mysql_cmd) . ' 2>&1', $output);
            $this->toConsole($output);
            $this->dieIfError($output);

        $mysql_cmd = "mysql -e 'drop database IF EXISTS `inventario_test`'";
        echo $this->mysql_cmd_echo($mysql_cmd);
            exec($this->mysql_cmd_exec($mysql_cmd) . ' 2>&1', $output);
            $this->toConsole($output);
            $this->dieIfError($output);

        return;
        */
        /*$tableNames = Schema::getConnection()
                                ->getDoctrineSchemaManager()
                                ->listTableNames();*/
        $tableNames = \DB::select('show tables');

        foreach ($tableNames as $table) {
            if ($table == 'migrations') {
                echo $this.' skipped!';
                continue;
            }
            echo $table.' truncated';
            \DB::table($table)->truncate();
        }
    }

    private function mysql_cmd_echo($mysql_cmd, $i = NULL){
        return '-- ' . $this->getSource_TAU_file($i) . PHP_EOL .
            sprintf($mysql_cmd . (is_null($i) ? '' : ' < ' . DIR .
                                                $this->getSource_TAU_file($i)) . PHP_EOL,
                                                DB_SERVER, DB_USER, '***');
    }

    private function mysql_cmd_exec($mysql_cmd, $i = NULL){
        return sprintf($mysql_cmd . (is_null($i)?'':' < ' . DIR .
                                                $this->getSource_TAU_file($i)) . PHP_EOL,
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

    private function dieIfError($output){
        if( in_array('ERROR', $output) !== false )
            die(1);
    }

    private function toConsole($output){
        if ($output) {
            foreach ($output as $lin) {
                echo $lin . PHP_EOL;
            }
            flush();
        }
    }
}
