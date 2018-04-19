<?php

/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 23/07/17
 * Time: 13:22
 *
 * Just gathers config values in a place
 */

namespace Modules\Administration\Tests\Entities;

trait ConfigTestValues
{
    private $debug = false;

    //private $testPrimaryKey = 10;

    private $testUserName = 'juan.español';
    private $testFirstName = 'Juan';
    private $testLastName = 'Español';

    private $testGroupName = 'Test Group';
    private $testGroupDescription = 'Group for Testing';

    private $testRoleName = 'Test Role';
    private $testRoleDescription = 'Role for Testing';

    public function __get($atr){
        if($atr == 'testPrimaryKey')
            return 1000; //rand(1000,2000);
        else
            return $this->atr;
    }

    public function dumperDump($x){
        (new Dumper)->dump($x);
        return $x;
    }
}