<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller {
	public function __construct() {
		$this->middleware(['permission:categories_read'])->only('index');
		$this->middleware(['permission:categories_create'])->only(['create', 'store']);
		$this->middleware(['permission:categories_update'])->only(['edit', 'update']);
		$this->middleware(['permission:categories_delete'])->only('destroy');
	}

	public function index(Request $request) {
		$categories = Category::when($request->search, function ($query) use ($request) {
			$query->whereTranslationLike('name', '%'.$request->search.'%');
		})->latest()->paginate(5);

		return view('dashboard.categories.index', compact('categories'));
	}

	public function create() {
		return view('dashboard.categories.create');
	}

	public function store(Request $request) {
		$rules = [];
		foreach (config('translatable.locales') as $locale) {
			$rules += [$locale.'.name' => ['required', Rule::unique('category_translations', 'name')]];
		}
		$request->validate($rules, [
			'required' => trans('site.required'),
		]);
		Category::create($request->except('_token'));
		toast(trans('site.added_sucessfully'), 'success');

		return redirect()->route('dashboard.categories.index');
	}

	public function edit($id) {
		$category = Category::findOrFail($id);

		return view('dashboard.categories.edit', compact('category'));
	}

	public function update(Request $request, Category $category) {
		$rules = [];
		foreach (config('translatable.locales') as $locale) {
			$rules += [
				$locale.'.name' => [
					'required',
					Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id'),
				],
			];
		}
		$request->validate($rules, [
			'required' => trans('site.required'),
		]);
		$category->update($request->except('_token', '_method'));
		toast(trans('site.updated_sucessfully'), 'success');

		return redirect()->route('dashboard.categories.index');
	}

	public function destroy($id) {
		Category::findOrFail($id)->delete();
		toast(trans('site.deleted_sucessfully'), 'success');

		return back();
	}
}
