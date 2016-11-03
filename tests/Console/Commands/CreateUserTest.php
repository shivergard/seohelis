<?php

use App\Console\Commands\CreateUser;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Container\Container;

class CreateUserTest extends TestCase
{

    private $console = false;

    function __construct() {
        $this->startTestSuite();
    }

    public function startTestSuite()
    {
        $this->console = new CreateUser(Container); 
    }

    public function testInstance()
    {
        $this->assertTrue($this->console instanceof CreateUser);
    }

}