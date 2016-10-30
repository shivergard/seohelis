<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use User;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {username} {?password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Admin user creating script';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    private function generatePassword($length = 8) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $username = $this->argument('username');

        if (User::where('username' , $username)->count() > 0){
            $this->error('User already exists');
            return;
        }

        if ($this->argument('password')){
            $password = $this->argument('password');
        }else{
            $password = $this->generatePassword(8);
        }

        $this->info('Create User '.$username.' with password '.$password);


    }
}
