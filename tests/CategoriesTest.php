<?php

usee App\Categories;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoriesTest extends TestCase
{

}


class freeRecruiterConsoleTest extends TestCase{

    private $console = false;

    function __construct() {
        $this->startTestSuite();
    }

    public function startTestSuite()
    {
        $this->categories = new Categories();  
    }

    /**
     * [testInstance description]
     * @return [type] [description]
     */
    public function testInstance()
    {
        $this->assertTrue($this->categories instanceof Categories);
    }

}