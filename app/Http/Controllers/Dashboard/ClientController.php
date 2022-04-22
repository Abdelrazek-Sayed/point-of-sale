<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller {
	public function index(Request $request) {
		$clients = Client::when($request->search, function ($query) use ($request) {
			$query->where('name', 'like', '%'.$request->search.'%')
				->orWhere('address', 'like', '%'.$request->search.'%')
				->orWhere('phone', 'like', '%'.$request->search.'%');
		})->latest()->paginate(5);

		return view('dashboard.clients.index', compact('clients'));
	}

	public function create() {
		return view('dashboard.clients.create');
	}

	public function store(Request $request) {
		//				return $request->all();
		$request->validate([
			'name'    => 'required',
			'phone'   => 'required|array|min:1',
			'phone.0' => 'required',
			'address' => 'required',
		], [
			'required' => trans('site.required'),
		]);
		$request_data = $request->except('_token');
		// array_filter() to cancel the null
		$request_data['phone'] = array_filter($request->phone);
		Client::create($request_data);
		toast(trans('site.added_sucessfully'), 'success');

		return redirect()->route('dashboard.clients.index');
	}

	public function edit(Client $client) {
		return view('dashboard.clients.edit', compact('client'));
	}

	public function update(Request $request, Client $client) {
		$request->validate([
			'name'    => 'required',
			'phone'   => 'required|array|min:1',
			'phone.0' => 'required',
			'address' => 'required',
		], [
			'required' => trans('site.required'),
		]);
		$request_data = $request->except('_token', '_method');
		// array_filter() to cancel the null
		$request_data['phone'] = array_filter($request->phone);
		$client->update($request_data);
		toast(trans('site.updated_sucessfully'), 'success');

		return redirect()->route('dashboard.clients.index');
	}

	public function destroy(Client $client) {
		$client->delete();
		toast(trans('site.deleted_sucessfully'), 'success');

		return back();
	}
}
