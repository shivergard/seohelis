<?php

use App\Console\Commands\ResetPassword;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Container\Container;

class ResetPasswordTest extends TestCase
{

    private $console = false;

    function __construct() {
        $this->startTestSuite();
    }

    public function startTestSuite()
    {
        $this->console = new ResetPassword(Container); 
    }

    public function testInstance()
    {
        $this->assertTrue($this->console instanceof ResetPassword);
    }

}