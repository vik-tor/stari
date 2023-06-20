<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $guarded = [];

	protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
	];
}
