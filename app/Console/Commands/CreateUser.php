<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use Config;
use Validator;

use App\Traits\UserHelper;

class CreateUser extends Command
{

    use UserHelper;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {username} {password?}';

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
            return 1;
        }

        if ($this->argument('password')){
            $password = $this->argument('password');
        }else{
            $password = $this->generatePassword(8);
        }

        $this->info('Create User '.$username.' with password '.$password);

        $userDetails =  array(
            'username' => $username,
            'email'    => $username.'@'.Config::get('app.domain'),
            'password' => bcrypt($password)
        );

        $validator = Validator::make($userDetails, [
            'username' => 'required|max:50',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        // Validate the arguments.
        if ($validator->fails()){
            // Failed validation.
            foreach($validator->messages()->getMessages() as $field_name => $messages) {
                // Go through each message for this field.
                foreach($messages AS $message) {
                    $this->error($field_name . ': ' . $message);
                }
            }
            return 1;
        }

        $newUser = User::create($userDetails);

        if ($newUser->id){
            $this->info('User created');
        }
    }
}