@extends('layouts.Dashboard.app')

@section('styles')

@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{__('site.dashboard') }}</a></li>

            <li class="breadcrumb-item"><a href="{{route('dashboard.categories.index')}}">{{__('site.categories') }}</a><span
                        class="text-red">{{ $categories->total() }}</span></li>
        </ol>
    </nav>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header col-md-12">

                            <form action="{{ route('dashboard.categories.index') }}" method="GET">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="search"
                                               value="{{ request()->search }}" placeholder="{{trans('site.search')}}"/>
                                    </div>
                                    <div class="form-group mx-1">
                                        <button type="submit" class="btn btn-info">  {{__('site.search')}}
                                            <i class="fa fa-search mx-2"></i></button>
                                    </div>
                                    <div class="form-group mx-3">
                                        @if(auth()->user()->hasPermission('categories_create'))
                                            <a href="{{route('dashboard.categories.create')}}"
                                               class="btn btn-info  text-center btn-sm  align-content-center">
                                                <h3 class="card-title">{{__('site.add_category')}}</h3>
                                            </a>
                                        @else
                                            <a href="" class="btn btn-info  btn-sm  text-center disabled">
                                                <h3 class="card-title">{{__('site.add_category')}}</h3>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0 with-border">
                        @if ($categories->count() > 0)
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('site.name')}}</th>
                                    <th>{{__('site.products_count')}}</th>
                                    <th>{{__('site.related_products')}}</th>
                                    <th>{{__('site.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$category->name }}</td>
                                        <td>{{$category->products->count() }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.products.index',['category_id'=>$category->id]) }}"
                                               class="btn btn-info btn-sm mx-2"> <i
                                                        class="fa fa-react mx-2"></i> {{__('site.related_products')}}
                                            </a>
                                        </td>

                                        <td>
                                            <div class="row">
                                                @if(auth()->user()->hasPermission('categories_update'))
                                                    <a href="{{ route('dashboard.categories.edit',$category->id) }}"
                                                       class="btn btn-info btn-sm mx-2"> <i
                                                                class="fa fa-user-edit mx-2"></i> {{__('site.edit')}}
                                                    </a>
                                                @else
                                                    <button href="#"
                                                            class="btn btn-info disabled"><i
                                                                class="fa fa-user-edit mx-2"></i>{{__('site.edit')}}
                                                    </button>
                                                @endif
                                                @if(auth()->user()->hasPermission('categories_delete'))
                                                    <form method="POST"
                                                          action="{{ route('dashboard.categories.destroy',$category->id) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                                class="btn btn-sm btn-danger btn-flat show_confirm"
                                                                data-toggle="tooltip"
                                                                title='Delete'><i
                                                                    class="fa fa-trash mx-2"></i>{{ __('site.delete') }}
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
                            {{ $categories->appends(request()->query())->links() }}
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
