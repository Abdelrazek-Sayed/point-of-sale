@extends('layouts.Dashboard.app')

@section('styles')

@endsection
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">{{__('site.dashboard') }}</a></li>

            <li class="breadcrumb-item"><a href="{{route('dashboard.users.index')}}">{{__('site.users') }}</a><span
                        class="text-red">{{ $users->total() }}</span></li>
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

                            <form action="{{ route('dashboard.users.index') }}" method="GET">
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
                                        @if(auth()->user()->hasPermission('users_create'))
                                            <a href="{{route('dashboard.users.create')}}"
                                               class="btn btn-info  text-center btn-sm  align-content-center">
                                                <h3 class="card-title">{{__('site.add_user')}}</h3>
                                            </a>
                                        @else
                                            <a href="" class="btn btn-info  btn-sm  text-center disabled">
                                                <h3 class="card-title">{{__('site.add_user')}}</h3>
                                            </a>
                                        @endif
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="card-body table-responsive p-0 with-border">
                            @if ($users->count() > 0)
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('site.first_name')}}</th>
                                        <th>{{__('site.last_name')}}</th>
                                        <th>{{trans('site.email')}}</th>
                                        <th>{{trans('site.image')}}</th>
                                        <th>{{__('site.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$user->first_name}}</td>
                                            <td>{{$user->last_name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                <img class="img-thumbnail" width="90" height="120"
                                                     src="{{ $user->image_path }}"/>
                                            </td>
                                            <td>
                                                <div class="row align-content-center">
                                                    @if(auth()->user()->hasPermission('users_update'))
                                                        <a href="{{ route('dashboard.users.edit',$user->id) }}"
                                                           class="btn btn-info btn-sm mx-2"> <i
                                                                    class="fa fa-user-edit mx-2"></i> {{__('site.edit')}}
                                                        </a>
                                                    @else
                                                        <button href="#"
                                                                class="btn btn-info btn-sm mx-2 disabled"><i
                                                                    class="fa fa-user-edit mx-2"></i>{{__('site.edit')}}
                                                        </button>
                                                    @endif
                                                    @if(auth()->user()->hasPermission('users_delete'))
                                                        <form method="POST"
                                                              action="{{ route('dashboard.users.destroy',$user->id) }}">
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
                                {{ $users->appends(request()->query())->links() }}
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
