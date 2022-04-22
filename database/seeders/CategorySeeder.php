<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		//		foreach (config('translatable.locales') as $locale) {
		//        Category::create(
		//			$locale.'.name'=> 'ملابس',
		//		);
		//		}
		Category::updateOrCreate([
			'ar' => [
				'name' => 'ملابس',
			],
			'en' => [
				'name' => 'clothes',
			],
		]);
		Category::updateOrCreate([
			'ar' => [
				'name' => 'احذية',
			],
			'en' => [
				'name' => 'shoes',
			],
		]);
		Category::updateOrCreate([
			'ar' => [
				'name' => 'الكترونيات',
			],
			'en' => [
				'name' => 'electronics',
			],
		]);
	}
}
