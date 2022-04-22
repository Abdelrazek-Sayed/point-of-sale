@extends('layouts.Dashboard.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><span class="text-white">{{__('site.add_category')}}</span></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('dashboard.categories.store')}}">
                            @csrf
                            <div class="card-body">
                                @foreach(config('translatable.locales') as $locale)
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{__("site.$locale.name")}}</label>
                                        <input type="text" class="form-control" name="{{$locale}}[name]"
                                               value="{{ old($locale. '.name')}}" id="exampleInputEmail1"
                                               placeholder="{{__("site.$locale.name")}}">
                                        @error("$locale.name") <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                @endforeach

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i
                                                class="fa fa-plus"></i> {{__('site.add')}}</button>
                                </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
