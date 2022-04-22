{{-- @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    </div>
@endif --}}


@if(session('success'))
    <div class="col-md-8 align-content-md-center">
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    </div>

{{--@section('scipts')--}}
{{--    <script>--}}
{{--        new Noty({--}}
{{--            type:'success',--}}
{{--            layout:'topRight',--}}
{{--            text:"{{session('success')}}",--}}
{{--            timeout:2500,--}}
{{--            killer:true,--}}
{{--        }).show();--}}
{{--    </script>--}}
{{--@endsection--}}
@endif

