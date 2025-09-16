<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable implements FilamentUser
{
	use HasApiTokens, HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'role',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'password'          => 'hashed',
	];

	/**
	 * @param Panel $panel
	 * @return bool
	 */
	public function canAccessPanel(Panel $panel): bool
	{
		return $this->role === 'admin';
	}

	/*** @return bool */
	public function isPremium(): bool
	{
		return $this->premium === 1;
	}
}
