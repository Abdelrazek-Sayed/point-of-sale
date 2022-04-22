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
                            <h3 class="card-title"><span class="text-white">{{__('site.edit_category')}}</span></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('dashboard.categories.update',$category->id)}}">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group">
                                    @foreach(config('translatable.locales') as $locale)
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{__("site.$locale.name")}}</label>
                                            <input type="text" class="form-control" name="{{$locale}}[name]"
                                                   value="{{ old($locale. '.name',$category->translate($locale)->name)}}" id="exampleInputEmail1"
                                                   placeholder="{{__("site.$locale.name")}}">
                                            @error("$locale.name") <span class="text-danger">{{$message}}</span> @enderror
                                        </div>
                                    @endforeach
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i
                                                class="fa fa-edit"></i> {{__('site.edit')}}</button>
                                </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
