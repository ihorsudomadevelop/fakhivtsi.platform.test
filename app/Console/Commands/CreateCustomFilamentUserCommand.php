<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

/**
 * Class CreateCustomFilamentUserCommand
 * @package App\Console\Commands
 */
class CreateCustomFilamentUserCommand extends Command
{
	/*** @var string */
	protected $signature   = 'filament:create-custom-user';
	/*** @var string */
	protected $description = 'Create a custom Filament user.';

	/*** @return void */
	public function handle(): void
	{
		$firstname = $this->ask('Enter the user\'s name:');
		$lastname  = $this->ask('Enter the user\'s role:');
		$email     = $this->ask('Enter the user\'s email address:');
		$password  = $this->secret('Enter the user\'s password:');
		if ($this->confirm('Do you want to create this user?')) {
			User::create([
				'name'     => $firstname,
				'role'     => $lastname,
				'email'    => $email,
				'password' => Hash::make($password),
			]);
			$this->info('User created successfully!');
		} else {
			$this->info('User creation cancelled.');
		}
	}
}
