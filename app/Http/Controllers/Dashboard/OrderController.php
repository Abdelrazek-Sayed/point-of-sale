<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	//	public function index(Request $request, Client $client) {
	//		return view('dashboard.orders.index', compact('client'));
	//	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request, Client $client) {
		$categories = Category::get();

		return view('dashboard.orders.create', compact('client', 'categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Order  $order
	 * @return \Illuminate\Http\Response
	 */
	public function show(Order $order) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Order  $order
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Order $order) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Order  $order
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Order $order) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Order  $order
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Order $order) {
		//
	}
}
