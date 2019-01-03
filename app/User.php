<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements  MustVerifyEmail
{
	use Notifiable;

	protected $fillable = [
		'name', 'email', 'password',
	];

	protected $hidden = [
		'password', 'remember_token',
	];

	public function tracks(): HasMany
	{
		return $this->hasMany(Track::class);
	}

	public function points(): HasManyThrough
	{
		return $this->hasManyThrough(Point::class, Track::class);
	}
}
