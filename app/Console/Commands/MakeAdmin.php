<?php

namespace SCF\Console\Commands;

use Illuminate\Console\Command;
use SCF\Models\User;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an admin';

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
        $firstName = $this->ask('What is your first name');
        $lastName = $this->ask('What about last name');
        $email = $this->ask('What is your email');
        $password = $this->secret('Type in the password');

        $user = User::create([
            'first_name' => $firstName,
            'last_name'  => $lastName,
            'email'      => $email,
            'password'   => bcrypt($password)
        ]);

        if ($user instanceof User) {
            $user->toggleVerified();
            $user->makeAdmin();
            $this->info("Admin [$firstName $lastName] created!");
        }
    }
}
