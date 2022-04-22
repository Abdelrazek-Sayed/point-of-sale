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
                            <h3 class="card-title"><span class="text-white">{{__('site.edit_user')}}</span></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('dashboard.users.update',$user->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('site.first_name')}}</label>
                                    <input type="text" class="form-control" name="first_name"
                                           value="{{old('first_name', $user->first_name) }}" id="exampleInputEmail1"
                                           placeholder="{{__('site.first_name')}}">
                                    @error('first_name') <span class="text-danger">{{$message}}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">{{__('site.last_name')}}</label>
                                    <input type="text" class="form-control" name="last_name"
                                           value="{{old('last_name', $user->last_name) }}"   id="" placeholder="{{__('site.last_name')}}">
                                    @error('last_name') <span class="text-danger">{{$message}}</span> @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__('site.email')}}</label>
                                    <input type="email" class="form-control" name="email" value="{{old('email', $user->email) }}"
                                           id="exampleInputEmail1" placeholder="{{__('site.email')}}">
                                    @error('email') <span class="text-danger">{{$message}}</span> @enderror
                                </div>

                                <div class="form-group"  x-data="{src: '{{ $user->image_path }}' }">
                                    <label for="image">{{__('site.image')}}</label>
                                    <input type="file" class="form-control " name="image"
                                           id="image" @change="src = URL.createObjectURL($event.target.files[0])">
                                    <img :src="src" class="img-thumbnail my-2" width="120">
                                    @error('image') <span class="text-danger">{{$message}}</span> @enderror
                                </div>

                                <div class="card-body">
                                    @php
                                    $models = ['users','categories','products','clients','orders'];
                                        $maps = ['create','read','update','delete'];
                                    @endphp
                                    <h4>{{__('site.permissions')}}</h4>
                                    <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">

                                        @foreach ($models as $index => $model)
                                            <li class="nav-item">
                                                <a class="nav-link {{$index == 0 ? 'active': ''}}" id="{{$model}}-tab"
                                                   data-toggle="pill" href="#{{$model}}" role="tab"
                                                   aria-controls="{{$model}}" aria-selected="true">{{$model}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-custom-content">
                                    </div>
                                    <div class="tab-content" id="custom-content-above-tabContent">
                                        @foreach ($models as $index => $model)
                                            <div class="tab-pane fade show {{$index == 0 ? 'active': ''}}"
                                                 id="{{$model}}" role="tabpanel" aria-labelledby="{{$model}}-tab">
                                                @foreach ($maps as $index => $map)
                                                    <label for="">
                                                        <input type="checkbox" name="permissions[]" @if($user->hasPermission($model.'_'.$map)) checked @endif value="{{$model.'_'.$map }}" class="form-group m-2">
                                                        {{__('site.'.$map)}}
                                                    </label>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> {{__('site.edit')}} </button>
                                </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
