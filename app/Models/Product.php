<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model implements TranslatableContract {
	use HasFactory, Translatable;

	protected $guarded = [];
	public $translatedAttributes = ['name', 'description'];

	protected function getImagePathAttribute() {
		return asset('uploads/images/products/'.$this->image);
	}

	protected function getProfitAttribute() {
		$profit      = $this->sale_price - $this->purchace_price;
		$profit_rate = $profit * 100 / $this->purchace_price;

		return number_format($profit_rate, 2);
	}

	public function category() {
		return $this->belongsTo(Category::class);
	}
}
