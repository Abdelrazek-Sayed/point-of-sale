<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller {
	public function __construct() {
		$this->middleware(['permission:categories_read'])->only('index');
		$this->middleware(['permission:categories_create'])->only(['create', 'store']);
		$this->middleware(['permission:categories_update'])->only(['edit', 'update']);
		$this->middleware(['permission:categories_delete'])->only('destroy');
	}

	public function index(Request $request) {
		$users = User::whereRoleIs('admin')->when($request->search, function ($query) use ($request) {
			$query->where('first_name', 'like', '%'.$request->search.'%')->whereRoleIs('admin')
				->orWhere('last_name', 'like', '%'.$request->search.'%')->whereRoleIs('admin')
				->orWhere('email', 'like', '%'.$request->search.'%')->whereRoleIs('admin');
		})->latest()->paginate(5);

		return view('dashboard.users.index', compact('users'));
	}

	public function create() {
		return view('dashboard.users.create');
	}

	public function store(Request $request) {
		$request->validate([
			'first_name' => 'required',
			'last_name'  => 'required',
			'email'      => 'required|unique:users,email',
			'password'   => 'required|confirmed|min:6',
			'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
			'permissions'  => 'required|array|min:1',
		], [
			'required' => trans('site.required'),
		]);
		$request_data             = $request->except('password', 'password_confirmation', 'permissions', 'image');
		$request_data['password'] = bcrypt($request->password);
		if ($request->image) {
			$img = Image::make($request->image);
			$img->resize(300, NULL, function ($constraint) {
				$constraint->aspectRatio();
			});
			$img->save(public_path('uploads/images/users/'.$request->image->hashName()));
			$request_data['image'] = $request->image->hashName();
		}
		$user = User::create($request_data);
		$user->attachRole('admin');
		$user->syncPermissions($request->permissions);

		toast(trans('site.added_sucessfully'),'success');

		return redirect()->route('dashboard.users.index');
	}


	public function edit($id) {
		$user = User::findOrFail($id);

		return view('dashboard.users.edit', compact('user'));
	}

	public function update(Request $request, User $user) {

		$request->validate([
			'first_name' => 'required',
			'last_name'  => 'required',
			'permissions'  => 'required|array|min:1',
			'email'      => 'required|unique:users,email,'.$user->id,
			'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
		], [
			'required' => trans('site.required'),
		]);
		$request_data = $request->except('permissions','image');
		if ($request->image) {
			if ($user->image != 'default_user.png') {
				Storage::disk('uploads')->delete('images/users/'.$user->image);
			}

			$img = Image::make($request->image);
			$img->resize(300, NULL, function ($constraint) {
				$constraint->aspectRatio();
			});
			$img->save(public_path('uploads/images/users/'.$request->image->hashName()));
			$request_data['image'] = $request->image->hashName();
		}

		$user->update($request_data);
		$user->syncPermissions($request->permissions);
		toast(trans('site.updated_sucessfully'),'success');
		return redirect()->route('dashboard.users.index');
	}

	public function destroy($id) {
		$user = User::findOrFail($id);
		if ($user->image != 'default_user.png') {
			Storage::disk('uploads')->delete('images/users/'.$user->image);
		}
		$user->delete();
		toast(trans('site.deleted_sucessfully'),'success');

		return back();
	}
}
