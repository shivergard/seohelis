<?php

use App\Traits\FeedHelper;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FeedHelperTest extends TestCase
{

    use FeedHelper;

    public function testReadFeed(){

        $this->assertTrue(method_exists($this , 'readFeed'));

    }

}