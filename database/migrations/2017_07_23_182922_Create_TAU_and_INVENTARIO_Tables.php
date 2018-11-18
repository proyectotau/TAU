<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\DB;

include_once 'tauproject/web/config.inc.php';

if( !defined('DIR') )
    define('DIR', base_path() . '/database/migrations/bd_test/');

/**
 * Class CreateTAUAndINVENTARIOTables
 *
 * This is an ad-hoc migration from legacy scripts
 * Soon will come from an Artisan Command that will parse SQL scripts and make a standard migration
 */
class CreateTAUAndINVENTARIOTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $mysql_cmd = 'mysql --line-numbers -v -v -v -h %s -u %s -p%s';

        for ($i = 0; $i <= 27; $i++){
            echo $this->mysql_cmd_echo($mysql_cmd, $i, $this->getSource_TAU_file($i));
            exec($this->mysql_cmd_exec($mysql_cmd, $i, $this->getSource_TAU_file($i)) . ' 2>&1', $output);
            $this->toConsoleAndDieIfError($output);
        }

        /*
        echo $this->mysql_cmd_echo($mysql_cmd, 99);
        exec($this->mysql_cmd_exec($mysql_cmd, 99) . ' 2>&1', $output);
        $this->toConsoleAndDieIfError($output);
        */
    }

    public function down(){

        $mysql_cmd_base = "mysql --line-numbers -v -v -v -h %s -u %s -p%s";

        $mysql_cmd = $mysql_cmd_base . " -e 'drop database IF EXISTS `tau_test`;'";
        echo $this->mysql_cmd_echo($mysql_cmd);
            exec($this->mysql_cmd_exec($mysql_cmd) . ' 2>&1', $output);
            $this->toConsoleAndDieIfError($output);

        $mysql_cmd = $mysql_cmd_base . " -e 'drop database IF EXISTS `inventario_test`;'";
        echo $this->mysql_cmd_echo($mysql_cmd);
            exec($this->mysql_cmd_exec($mysql_cmd) . ' 2>&1', $output);
            $this->toConsoleAndDieIfError($output);
    }

    private function mysql_cmd_echo($mysql_cmd, $i = NULL, $fromFile = null){
        return (is_null($fromFile) ? '' : ('-- ' . $fromFile . PHP_EOL)) .
            sprintf($mysql_cmd . (is_null($fromFile) ? '' : ' < ' . DIR . $fromFile) . PHP_EOL,
                                                DB_SERVER, DB_USER, '***');
    }

    private function mysql_cmd_exec($mysql_cmd, $i = NULL, $fromFile = null){
        return sprintf($mysql_cmd . (is_null($fromFile) ? '' : ' < ' . DIR . $fromFile),
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

    private function toConsoleAndDieIfError($output){
        if ($output) {
            foreach ($output as $lin) {
                echo $lin . PHP_EOL;
                if (strpos($lin, 'ERROR ') !== false){
                    die(1);
                }
            }
            flush();
        }
    }
}
