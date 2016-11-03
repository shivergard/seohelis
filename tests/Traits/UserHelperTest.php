<?php

use App\Traits\UserHelper;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserHelperTest extends TestCase
{

    use UserHelper;

    public function testGeneratePasswordInstance(){

        $this->assertTrue(method_exists($this , 'generatePassword'));

    }

    public function testGeneratePasswordLenght(){
        $lenght = 8;
        $this->assertTrue(strlen($this->generatePassword($lenght)) == $lenght);
    }

    public function testGeneratePasswordInvalidValue(){
        $lenght = 'albatross';

        try {
            $this->generatePassword($lenght);
            $this->assertTrue(false);
        } catch (TypeError $e) {
            $this->assertTrue(strpos($e->getMessage(), 'Argument 1 passed to UserHelperTest::generatePassword() must be of the type integer, string given')  > -1);
        }
    }

}