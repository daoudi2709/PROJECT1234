@extends('layout')

@section('content')
<h3>Add Students </h3>
<form action="{{route('students.store')}}" method="POST"enctype="multipart/form-data">
    {{csrf_field() }}
    <div class="form-group">
        <label for="name" >Name</label>
        <input type="text" name="name" class="form-control">
        @if ($errors->get('name'))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->get('name') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="form-group">
        <label for="email" >Email</label>
        <input type="text" name="email" class="form-control">
        @if ($errors->get('email'))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->get('email') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

    </div>
    <div class="form-group">
        <label for="phone" >Phone</label>
        <input type="text" name="phone" class="form-control" placeholder="your Phone : " >
        @if ($errors->get('phone'))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->get('phone') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="form-group">
        <label for="section" >Section</label>
        <input type="text" name="section" class="form-control">
        @if ($errors->get('section'))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->get('section') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="form-group">
        <label for="image" >Image</label>
        <input type="file" name="image" class="form-control">
        @if ($errors->get('image'))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->get('image') as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <button type="submit" class="btn btn-primary">Add Student</button> 

@endsection