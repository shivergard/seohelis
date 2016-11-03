<?php

use App\Categories;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoriesTest extends TestCase
{

    private $categories = false;

    function __construct() {
        $this->startTestSuite();
    }

    public function startTestSuite()
    {
        $this->categories = new Categories();  
    }

    public function testInstance()
    {
        $this->assertTrue($this->categories instanceof Categories);
    }

    public function testBasicTable(){
        $this->assertTrue($this->categories->getTable() == 'categories');   
    }


    public function testFillableValues(){

        $actual = $this->categories->getFillable();

        $expected = ['name', 'description'];

        $this->assertEmpty(array_merge(array_diff($expected, $actual), array_diff($actual, $expected))); 
    }
}