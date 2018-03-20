<?php

/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 23/07/17
 * Time: 13:22
 *
 * Just gathers config values in a place
 */

namespace Modules\Administration\Tests;

trait ConfigTestValues
{
    private $debug = false;

    private $testPrimaryKey = 10;

    private $testUserName = 'juan.espanol';
    private $testFirstName = 'Juan';
    private $testLastName = 'Espanol';

    private $testGroupName = 'Test Group';
    private $testGroupDescription = 'Group for Testing';

    private $testRoleName = 'Test Role';
    private $testRoleDescription = 'Role for Testing';
}