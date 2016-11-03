<?php

use App\Http\Controllers\FeedSourcesController;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Http\Request;

class FeedSourcesControllerTest extends TestCase
{

    private $console = false;

    function __construct() {
        $this->startTestSuite();
    }

    public function startTestSuite()
    {
        $this->createApplication();

        $this->console = new FeedSourcesController( new Request());  
    }

    public function testInstance()
    {
        $this->assertTrue($this->console instanceof FeedSourcesController);
    }

}