@extends('layouts.Dashboard.app')

@section('styles')

@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{__('site.dashboard') }}</a></li>

            <li class="breadcrumb-item"><a
                        href="{{route('dashboard.products.index')}}">{{__('site.products') }}</a><span
                        class="text-red">{{ $products->total() }}</span></li>
        </ol>
    </nav>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">

                            <form action="{{ route('dashboard.products.index') }}" method="GET">
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <input type="text" class="form-control" name="search"
                                               value="{{ request()->search }}" placeholder="{{trans('site.search')}}"/>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <select name="category_id"
                                                class="form-control select2 select2-hidden-accessible"
                                                style="width: 100%;" data-select2-id="1" tabindex="-1"
                                                aria-hidden="true">
                                            <option value="">{{__('site.categories')}}</option>
                                            @foreach($categories as $category)
                                                <option data-select2-id="15" label=""
                                                        value="{{$category->id}}" {{ request()->category_id == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id') <span
                                                class=" text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group mx-3">
                                        <button type="submit" class="btn btn-info">  {{__('site.search')}}
                                            <i class="fa fa-search mx-2"></i></button>
                                    </div>
                                    <div class="form-group">
                                        @if(auth()->user()->hasPermission('users_create'))
                                            <a href="{{route('dashboard.products.create')}}"
                                               class="btn btn-info btn-sm">
                                                <h3 class="card-title">{{__('site.add_product')}}</h3>
                                            </a>
                                        @else
                                            <a href="" class="btn btn-info  btn-sm  text-center disabled">
                                                <h3 class="card-title">{{__('site.add_product')}}</h3>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body table-responsive p-0 with-border">
                            @if ($products->count() > 0)
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('site.name')}}</th>
                                        <th>{{__('site.description')}}</th>
                                        <th>{{__('site.purchace_price')}}</th>
                                        <th>{{__('site.sale_price')}}</th>
                                        <th>{{__('site.stock')}}</th>
                                        <th>{{__('site.profit_rate')}}</th>
                                        <th>{{__('site.category')}}</th>
                                        <th>{{__('site.image')}}</th>
                                        <th>{{__('site.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$product->name}}</td>
                                            <td>{!! $product->description !!}</td>
                                            <td>{{$product->purchace_price}}</td>
                                            <td>{{$product->sale_price}}</td>
                                            <td>{{$product->stock}}</td>
                                            <td>{{$product->profit}} %</td>
                                            <td>{{$product->category->name}}</td>
                                            <td>
                                                <img class="img-thumbnail" width="90" height="120"
                                                     src="{{ $product->image_path }}"/>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    @if(auth()->user()->hasPermission('products_update'))
                                                        <a href="{{ route('dashboard.products.edit',$product->id) }}"
                                                           class="btn btn-info btn-sm"> <i
                                                                    class="fa fa-user-edit mx-2"></i>
                                                        </a>
                                                    @else
                                                        <button href="#"
                                                                class="btn btn-info disabled"><i
                                                                    class="fa fa-user-edit mx-2"></i>{{__('site.edit')}}
                                                        </button>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('products_delete'))
                                                        <form method="POST"
                                                              action="{{ route('dashboard.products.destroy',$product->id) }}">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-danger btn-flat show_confirm"
                                                                    data-toggle="tooltip"
                                                                    title='Delete'><i
                                                                        class="fa fa-trash mx-2"></i>
                                                            </button>

                                                        </form>
                                                    @else
                                                        <button href="#"
                                                                class="btn btn-danger disabled"><i
                                                                    class="fa fa-trash mx-2"></i> {{__('site.delete')}}
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $products->appends(request()->query())->links() }}
                            @else
                                <h3>{{ __('site.no_data')}}</h3>
                            @endif
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">

        $('.show_confirm').click(function (event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: `{{ trans('site.confirm_delete') }}`,
                text: "",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });

    </script>


@endsection
