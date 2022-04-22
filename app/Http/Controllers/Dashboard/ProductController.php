<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ProductController extends Controller {
	public function __construct() {
		$this->middleware(['permission:products_read'])->only('index');
		$this->middleware(['permission:products_create'])->only(['create', 'store']);
		$this->middleware(['permission:products_update'])->only(['edit', 'update']);
		$this->middleware(['permission:products_delete'])->only('destroy');
	}

	public function index(Request $request) {
		$categories = Category::get();
		$products   = Product::query()->when($request->search, function ($q) use ($request) {
			return $q->whereTranslationLike('name', '%'.$request->search.'%');
		})->when($request->category_id, function ($query) use ($request) {
			$query->where('category_id', $request->category_id);
		})->latest()->paginate(3);

		return view('dashboard.products.index', compact('products', 'categories'));
	}

	public function create() {
		$categories = Category::get();

		return view('dashboard.products.create', compact('categories'));
	}

	public function store(Request $request) {
		$rules = [
			'purchace_price' => 'required|numeric',
			'sale_price'     => 'required|numeric',
			'stock'          => 'required|numeric',
			'category_id'    => 'required|exists:categories,id',
			'image'          => 'nullable|image|mimes:jpg,jpeg,png,gif',
		];
		foreach (config('translatable.locales') as $locale) {
			$rules += [$locale.'.name' => ['required', Rule::unique('product_translations', 'name')]];
			$rules += [$locale.'.description' => 'required'];
		}
		$request->validate($rules, [
			'required' => trans('site.required'),
		]);
		$request_data = $request->except('_token', 'image');
		if ($request->image) {
			$img = Image::make($request->image);
			$img->resize(300, NULL, function ($constraint) {
				$constraint->aspectRatio();
			});
			$img->save(public_path('uploads/images/products/'.$request->image->hashName()));
			$request_data['image'] = $request->image->hashName();
		}
		Product::create($request_data);
		toast(trans('site.added_sucessfully'), 'success');

		return redirect()->route('dashboard.products.index');
	}

	public function edit(Product $product) {
		$categories = Category::get();

		return view('dashboard.products.edit', compact('product', 'categories'));
	}

	public function update(Request $request, Product $product) {
		$rules = [
			'purchace_price' => 'required|numeric',
			'sale_price'     => 'required|numeric',
			'stock'          => 'required|numeric',
			'category_id'    => 'required|exists:categories,id',
			'image'          => 'nullable|image|mimes:jpg,jpeg,png,gif',
		];
		foreach (config('translatable.locales') as $locale) {
			$rules += [
				$locale.'.name' => [
					'required',
					Rule::unique('product_translations', 'name')->ignore(
						$product->id,
						'product_id'
					),
				],
			];
			$rules += [$locale.'.description' => 'required'];
		}
		$request->validate($rules, [
			'required' => trans('site.required'),
		]);
		$request_data = $request->except('_token', 'image', '_method');
		if ($request->image) {
			if ($product->image != 'default_product.png') {
				Storage::disk('uploads')->delete('images/products/'.$product->image);
			}
			$img = Image::make($request->image);
			$img->resize(300, NULL, function ($constraint) {
				$constraint->aspectRatio();
			});
			$img->save(public_path('uploads/images/products/'.$request->image->hashName()));
			$request_data['image'] = $request->image->hashName();
		}
		$product->update($request_data);
		toast(trans('site.updated_sucessfully'), 'success');

		return redirect()->route('dashboard.products.index');
	}

	public function destroy(Product $product) {
		if ($product->image != 'default_product.png') {
			Storage::disk('uploads')->delete('images/products/'.$product->image);
		}
		$product->delete();
		toast(trans('site.deleted_sucessfully'), 'success');

		return back();
	}
}
