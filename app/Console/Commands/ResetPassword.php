<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use Validator;

use App\Traits\UserHelper;

class ResetPassword extends Command
{

    use UserHelper;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:password_reset {username} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset password for user';

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

        $userSelect = User::where('username' , $username);

        if ($userSelect->count() == 0){
            $this->error("User doesn't exists");
            return 1;
        }

        if ($this->argument('password')){
            $password = $this->argument('password');
        }else{
            $password = $this->generatePassword(8);
        }

        

        $validator = Validator::make(
            array(
                'password' => $password
            ), [
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()){
            foreach($validator->messages()->getMessages() as $field_name => $messages) {
                foreach($messages AS $message) {
                    $this->error($field_name . ': ' . $message);
                }
            }
            return 1;
        }

        $userModel = $userSelect->first();

        $userModel->password = bcrypt($password);

        if ($userModel->save()){
            $this->info(ucfirst($username).' password is '.$password);
        }else{
            $this->error('Error saving password');
            return 1;
        }
    }
}
