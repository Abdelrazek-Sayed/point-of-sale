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
                            <h3 class="card-title"><span class="text-white">{{__('site.edit_client')}}</span></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('dashboard.clients.update',$client->id)}}">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('site.name')}}</label>
                                    <input type="text" class="form-control" name="name"
                                           value="{{ old('name',$client->name)}}" id="exampleInputEmail1"
                                           placeholder="{{__('site.name')}}">
                                    @error('name') <span class="text-danger">{{$message}}</span> @enderror
                                </div>


                                @for($i = 0 ; $i<2 ;$i++)
                                    <div class="form-group">
                                        <label for="">{{__('site.phone_'.$i+1)}}</label>
                                        <input type="text" class="form-control" name="phone[]"
                                               value="{{ old('phone.'.$i , $client->phone[$i] ?? '') }}">
                                        @error('phone.'.$i) <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                @endfor
                                <div class="form-group">
                                    <label for="">{{__('site.address')}}</label>
                                    <textarea class="form-control ckeditor"
                                              name="address">{{ old('address',$client->address)}}</textarea>
                                    @error('address') <span class="text-danger">{{$message}}</span> @enderror
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-danger"><i
                                                class="fa fa-plus"></i> {{__('site.edit')}}</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
