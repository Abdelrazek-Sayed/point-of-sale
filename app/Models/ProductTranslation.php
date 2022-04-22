<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model {
	use HasFactory;

	public $timestamps = FALSE;
	protected $fillable = ['name', 'description'];
}
