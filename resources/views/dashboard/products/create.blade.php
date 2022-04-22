@extends('layouts.Dashboard.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            @if($categories->count() > 0)
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><span class="text-white">{{__('site.add_product')}}</span></h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" method="POST" action="{{route('dashboard.products.store')}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="col-md-12 row">
                                        @foreach(config('translatable.locales') as $locale)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">{{__("site.$locale.name")}}</label>
                                                    <input type="text" class="form-control" name="{{$locale}}[name]"
                                                           value="{{ old($locale. '.name')}}" id="exampleInputEmail1"
                                                           placeholder="{{__("site.$locale.name")}}">
                                                    @error("$locale.name") <span
                                                            class="text-danger">{{$message}}</span> @enderror
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-12 row">
                                        @foreach(config('translatable.locales') as $locale)
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">{{__("site.$locale.description")}}</label>
                                                    <textarea class="form-control ckeditor"
                                                              name="{{$locale}}[description]">
                                                        {{ old($locale. '.description')}}
                                                    </textarea>
                                                    @error("$locale.description") <span
                                                            class="text-danger">{{$message}}</span> @enderror
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="col-md-12 row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">{{__('site.purchace_price')}}</label>
                                                <input type="text" class="form-control" name="purchace_price"
                                                       value="{{ old('purchace_price')}}">
                                                @error('purchace_price') <span
                                                        class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">{{__('site.sale_price')}}</label>
                                                <input type="number" class="form-control" name="sale_price"
                                                       value="{{ old('sale_price')}}"
                                                       id="exampleInputEmail1">
                                                @error('sale_price') <span
                                                        class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">{{__('site.stock')}}</label>
                                                <input type="number" class="form-control" name="stock"
                                                       value="{{ old('stock')}}" >
                                                @error('stock') <span class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">{{__('site.categories')}}</label>
                                                <div class="form-group">
                                                    <select name="category_id" class="form-control select2 select2-hidden-accessible"
                                                            style="width: 100%;" data-select2-id="1" tabindex="-1"
                                                            aria-hidden="true">
                                                        @foreach($categories as $category)
                                                            <option data-select2-id="15" label=""
                                                                    value="{{$category->id}}">{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('category_id') <span
                                                        class=" text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-12 row">
                                        <div class="col-md-6">
                                            <div class="form-group"
                                                 x-data="{src: '{{ asset('uploads/images/products/default_product.png') }}' }">
                                                <label for="image">{{__('site.image')}}</label>
                                                <input type="file" class="form-control " name="image"
                                                       id="image"
                                                       @change="src = URL.createObjectURL($event.target.files[0])">
                                                <img :src="src" class="img-thumbnail my-2" width="120">
                                                @error('image') <span
                                                        class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary"><i
                                                            class="fa fa-plus"></i> {{__('site.add')}}</button>
                                            </div>
                                        </div>
                                    </div>

                            </form>
                        </div>
                        <!-- /.card -->
                        <!-- /.card -->
                    </div>

                </div>
            @else
                <h3>{{ __('site.no_categories')}}</h3>
            @endif
        </div><!-- /.container-fluid -->
    </section>
@endsection
