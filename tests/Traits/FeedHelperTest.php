<?php

use App\Traits\FeedHelper;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FeedHelperTest extends TestCase
{

    use FeedHelper;

    public function testReadFeedInstance(){
        $this->assertTrue(method_exists($this , 'readFeed'));
    }

    public function testReadFeedReturnsArrray(){
        $this->assertTrue(is_array($this->readFeed('http://ss.lv')));
    }

    public function testReadFeedReturnsFilledArrayValidFeed(){
        $this->assertTrue(count($this->readFeed('http://rss.cnn.com/rss/edition.rss')) > 0);
    }

    public function testReadFeedReturnsEmptyArrayInvalidFeed(){
        $this->assertTrue(count($this->readFeed('http://ss.lv')) == 0);
    }

    public function testReadFeedReturnsEmptyArrayInvalidUrl(){
        $this->assertTrue(count($this->readFeed('pokemoni')) == 0);
    }

}