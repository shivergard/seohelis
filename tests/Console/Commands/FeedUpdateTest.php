<?php

use App\Console\Commands\FeedUpdate;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Container\Container;

class FeedUpdateTest extends TestCase
{

    private $console = false;

    function __construct() {
        $this->startTestSuite();
    }

    public function startTestSuite()
    {
        $this->console = new FeedUpdate(Container); 
    }

    public function testInstance()
    {
        $this->assertTrue($this->console instanceof FeedUpdate);
    }

}