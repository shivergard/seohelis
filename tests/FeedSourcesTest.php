<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\FeedSources;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FeedSourcesTest extends TestCase
{

    private $feedSources = false;

    function __construct() {
        $this->startTestSuite();
    }

    public function startTestSuite()
    {
        $this->feedSources = new FeedSources();  
    }

    public function testInstance()
    {
        $this->assertTrue($this->feedSources instanceof FeedSources);
    }

    public function testBasicTable(){
        $this->assertTrue($this->feedSources->getTable() == 'feed_sources');   
    }


    public function testFillableValues(){

        $actual = $this->feedSources->getFillable();

        $expected = ['title', 'description' , 'url' , 'provider_url' ,'category_id'];

        $this->assertEmpty(array_merge(array_diff($expected, $actual), array_diff($actual, $expected))); 
    }

    public function testCategory(){

        $this->assertTrue(method_exists($this->feedSources , 'category'));

        $this->assertTrue($this->feedSources->category() instanceof HasOne);

    }
}
