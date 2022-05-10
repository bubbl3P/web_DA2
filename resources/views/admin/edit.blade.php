{{--<form action="{{ route('courses.update', $each) }}" method="post">--}}
{{--    @csrf--}}
{{--    @method('PUT')--}}
{{--    Name--}}
{{--    <input type="text" name="name" value="{{ $each->name }}">--}}
{{--    @if($errors->has('name'))--}}
{{--        <span class="error">--}}
{{--            {{ $errors->first('name') }}--}}
{{--        </span>--}}
{{--    @endif--}}
{{--    <br>--}}
{{--    <button>Update</button>--}}
{{--</form>--}}
@extends('admin.layout.master')
@push('css')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.11.5/b-2.2.2/b-colvis-2.2.2/b-html5-2.2.2/b-print-2.2.2/date-1.1.2/fc-4.0.2/fh-3.2.2/r-2.2.9/rg-1.1.4/sc-2.0.5/sb-1.3.2/sl-1.3.4/datatables.min.css"/>
@endpush
@section('content')
    <div class='card'>
        @if ($errors->any())
            <div class="card-header">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <form action="{{route('courses.update', $each)}}" method="post" style="padding: 30px; text-align: center">
            @csrf
            @method('PUT')
            <label>Name:</label>
            <input type="text" name="name" value="{{$each->name}}" style="margin-left: 50px; margin-bottom: 10px">
            <br>
            <label>Detail:</label>
            <input type="text" name="detail" value="{{$each->detail}}" style="margin-left: 50px; margin-bottom: 10px">
            <br>
            <label>Price:</label>
            <input type="number" name="price" value="{{$each->price}}" style="margin-left: 56px; margin-bottom: 10px">
            <br>
            <button class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
