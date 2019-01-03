<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Track extends Model
{
	public function points(): HasMany
	{
		return $this->hasMany(Point::class);
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
