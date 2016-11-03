<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\FeedsItems;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FeedsItemsTest extends TestCase
{

    private $feedItems = false;

    function __construct() {
        $this->startTestSuite();
    }

    public function startTestSuite()
    {
        $this->feedItems = new FeedsItems();  
    }

    public function testInstance()
    {
        $this->assertTrue($this->feedItems instanceof FeedsItems);
    }

    public function testBasicTable(){
        $this->assertTrue($this->feedItems->getTable() == 'feeds');   
    }


    public function testFillableValues(){

        $actual = $this->feedItems->getFillable();

        $expected = [];

        $this->assertEmpty(array_merge(array_diff($expected, $actual), array_diff($actual, $expected))); 
    }

    public function testSource(){

        $this->assertTrue(method_exists($this->feedItems , 'source'));

        $this->assertTrue($this->feedItems->source() instanceof HasOne);

    }
}
