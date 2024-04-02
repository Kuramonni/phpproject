<?php
// tests/AppTest.php
// vendor/bin/phpunit tests/AppTest.php

use PHPUnit\Framework\TestCase;

// Include the file containing the functions to be tested
require_once 'C:\xampp\htdocs\phpproject\includes\functions.inc.php'; 

class AppTest extends TestCase
{
    public function testEmptyInputSignup()
    {
        // Test empty input scenario
        $this->assertTrue(emptyInputSignup('', '', '', '', ''));

        // Test non-empty input scenario
        $this->assertFalse(emptyInputSignup('John Doe', 'john@example.com', 'johndoe', 'password', 'password'));
    }

    public function testInvalidUid()
    {
        // Test invalid username scenario
        $this->assertTrue(invalidUid('user!name'));

        // Test valid username scenario
        $this->assertFalse(invalidUid('username'));
    }

    public function testInvalidEmail()
    {
        // Test invalid email scenario
        $this->assertTrue(invalidEmail('invalid-email'));

        // Test valid email scenario
        $this->assertFalse(invalidEmail('valid@example.com'));
    }

    public function testPwdMatch()
    {
        // Test passwords match scenario
        $this->assertFalse(pwdMatch('password', 'different'));

        // Test passwords don't match scenario
        $this->assertTrue(pwdMatch('password', 'password'));
    }

    
}
