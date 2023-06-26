<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entry extends Model
{
	use HasFactory;
	use SoftDeletes;

	protected $guarded = [];

	protected $casts = [
		'created_at' => 'datetime:Y-m-d H:i:s',
	];

	public function notebook(): BelongsTo
	{
		return $this->belongsTo(Notebook::class);
	}
}
