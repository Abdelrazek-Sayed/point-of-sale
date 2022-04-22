@extends('layouts.Dashboard.app')

@section('styles')

@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{__('site.dashboard') }}</a></li>

            <li class="breadcrumb-item"><a href="{{route('dashboard.clients.index')}}">{{__('site.clients') }}</a><span
                        class="text-red">{{ $clients->total() }}</span></li>
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

                            <form action="{{ route('dashboard.clients.index') }}" method="GET">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="search"
                                               value="{{ request()->search }}"/>
                                    </div>
                                    <div class="form-group mx-1">
                                        <button type="submit" class="btn btn-info">  {{__('site.search')}}
                                            <i class="fa fa-search mx-2"></i></button>
                                    </div>

                                    <div class="form-group mx-1">
                                        @if(auth()->user()->hasPermission('clients_create'))
                                            <a href="{{route('dashboard.clients.create')}}"
                                               class="btn btn-info  text-center btn-sm  align-content-center">
                                                <h3 class="card-title">{{__('site.add_client')}}</h3>
                                            </a>
                                        @else
                                            <a href="" class="btn btn-info  btn-sm  text-center disabled">
                                                <h3 class="card-title">{{__('site.add_client')}}</h3>
                                            </a>
                                        @endif
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="card-body table-responsive p-0 with-border">
                            @if ($clients->count() > 0)
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('site.name')}}</th>
                                        <th>{{__('site.phone')}}</th>
                                        <th>{{trans('site.address')}}</th>
                                        <th>{{trans('site.add_order')}}</th>
                                        <th>{{__('site.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$client->name}}</td>
                                            <td>{{ implode(' - ',$client->phone) }}</td>
                                            <td>{!! Str::substr($client->address, 4, 7)   !!}</td>
                                            <td>
                                                <div class="row align-content-center">
                                                    @if(auth()->user()->hasPermission('orders_create'))
                                                        <a href="{{ route('dashboard.orders.create',$client->id) }}"
                                                           class="btn btn-info btn-sm mx-2"> <i
                                                                    class="fa fa-user-edit mx-2"></i> {{__('site.add_order')}}
                                                        </a>
                                                    @else
                                                        <button href="#"
                                                                class="btn btn-info btn-sm mx-2 disabled"><i
                                                                    class="fa fa-user-edit mx-2"></i>{{__('site.add_order')}}
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row align-content-center">
                                                    @if(auth()->user()->hasPermission('clients_update'))
                                                        <a href="{{ route('dashboard.clients.edit',$client->id) }}"
                                                           class="btn btn-info btn-sm mx-2"> <i
                                                                    class="fa fa-user-edit mx-2"></i> {{__('site.edit')}}
                                                        </a>
                                                    @else
                                                        <button href="#"
                                                                class="btn btn-info btn-sm mx-2 disabled"><i
                                                                    class="fa fa-user-edit mx-2"></i>{{__('site.edit')}}
                                                        </button>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('clients_delete'))
                                                        <form method="POST"
                                                              action="{{ route('dashboard.clients.destroy',$client->id) }}">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                    class="btn btn-sm mx-2 btn-danger btn-flat show_confirm"
                                                                    data-toggle="tooltip"
                                                                    title='Delete'><i
                                                                        class="fa fa-trash mx-2"></i>{{ __('site.delete') }}
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button href="#"
                                                                class="btn btn-danger btn-sm mx-2 disabled"><i
                                                                    class="fa fa-trash mx-2"></i> {{__('site.delete')}}
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $clients->appends(request()->query())->links() }}
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
