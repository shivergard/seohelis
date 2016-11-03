<?php

use App\Traits\UserHelper;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserHelperTest extends TestCase
{

    use UserHelper;

    public function testGeneratePassword(){

        $this->assertTrue(method_exists($this , 'generatePassword'));

    }

}