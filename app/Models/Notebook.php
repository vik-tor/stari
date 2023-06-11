<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Notebook extends Model
{
	use HasFactory;

	protected $guarded = [];

	public function Entries(): HasMany
	{
		return $this->hasMany(Entry::class);
	}
}
