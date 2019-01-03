<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Point extends Model
{
	public function track(): BelongsTo
	{
		return $this->belongsTo(Track::class);
	}
}
