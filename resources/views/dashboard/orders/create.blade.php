@extends('layouts.Dashboard.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->

                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
 
                                <div class="col-6">
                                    <div class="card-header">
                                        <h3 class="card-title">{{ trans('site.categories') }}</h3>
                                    </div>
                                    @foreach ($categories as $index => $category)
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="panel-group">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a data-toggle="collapse"
                                                                    href="#cat_{{ $index }}">{{ $category->name }}</a>
                                                            </h4>
                                                        </div>
                                                        <div id="cat_{{ $index }}" class="panel-collapse collapse">
                                                            @if ($category->products->count() > 0)
                                                                {{-- <div class="panel-body">Panel Body</div> --}}
                                                                <table class="table table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>{{ __('site.name') }}</th>
                                                                            <th>{{ __('site.price') }}</th>
                                                                            <th>{{ __('site.stock') }}</th>
                                                                            <th>{{ __('site.add') }}</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($category->products as $product)
                                                                            <tr>

                                                                                <td>{{ $product->name }}</td>
                                                                                <td>{{ $product->sale_price }}</td>
                                                                                <td>{{ $product->stock }}</td>
                                                                                <td>
                                                                                    <div class="row">
                                                                                        @if (auth()->user()->hasPermission('orders_update'))
                                                                                            <a data-name="{{ $product->name }}"
                                                                                                data-id="{{ $product->id }}"
                                                                                                data-price="{{ $product->sale_price }}"
                                                                                                id="product_{{ $product->id }}"
                                                                                                {{-- href="{{ route('dashboard.orders.create', $product->id) }}" --}}
                                                                                                class="btn btn-success btn-sm add_order">
                                                                                                <i
                                                                                                    class="fa fa-plus mx-2"></i>
                                                                                            </a>
                                                                                        @else
                                                                                            <button href="#"
                                                                                             
                                                                                                class="btn btn-success btn-sm disabled">
                                                                                                <i
                                                                                                    class="fa fa-plus mx-2"></i>
                                                                                            </button>
                                                                                        @endif

                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    @endforeach
                                    <!-- /.card -->
                                </div>
                                <div class="col-md-6">
                                    <div class="card-header">
                                        <h3 class="card-title"><span
                                                class="text-blue">{{ __('site.orders') }}</span>
                                        </h3>
                                        <div class="card-body">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">{{ __('site.name') }}</th>
                                                        <th scope="col">{{ __('site.qty') }}</th>
                                                        <th scope="col" >{{ __('site.price') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="order_list">

                                                </tbody>
                                            </table>
                                            <hr>
                                            <span class="text-success">
                                                {{ __('site.total') }} : <span class="text-danger" id="total_price"></span>
                                            </span>
                                        </div>

                                        <div class="d-grid gap-2">
                                            <a class="btn  btn-info disabled" id="add_order_btn">
                                                {{ __('site.add_order') }}
                                            </a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </section>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('dashboard/custom/add_order.js') }}"></script>
@endsection
