@extends('layout')

@section('content')
@if(session()->has('success'))
<div class="alert alert-success">
    {{session()->get('success')}}
</div>
@endif
<a href="{{('students/create')}}" class="btn btn-primary">
                <button class="icon-btn add-btn">
                    <div class="add-icon"></div>
                    <div class="btn-txt">add your profile</div>
                </button>
</a>
<div class="table-wrapper">
    <table class="fl-table">
        <thead><tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Section</th>
            <th>Image</th>
            <th>Show</th>
            <th>Update</th>
            <th>Delete</th>
        </tr></thead>
        <tbody>
            @foreach($students as $student)
        <tr>
            <td>{{$student->id}}</td>
            <td>{{$student->name}}</td>
            <td>{{$student->email}}</td>
            <td>{{$student->phone}}</td>
            <td>{{$student->section}}</td>
            <td><img src="/image/{{$student->image}}" width="96" height="96"/></td>
            <td>
            <form method="POST">
            <a class="btn btn-info" href="{{route('students.show', $student->id)}}">Show</a>
            </form>
            </td>
            <td>
            <form method="POST">
            <a class="btn btn-primary" href="{{route('students.edit', $student->id)}}">Edit</a>
            </form>
            </td>
            <td>
           <form id="{{ $student->id }}" action="{{route('students.destroy', $student->id)}}" method="POST">
                {{csrf_field()}}
                {{method_field('DELETE')}}
           </form>
           <button 
                onclick="event.preventDefault();
                if(confirm('voulez-vous supprimer votre profil ??'))
                document.getElementById({{ $student->id }}).submit();" type="submit" class="btn btn-danger">Delete</button>
            </td>
        </tr>
        @endforeach
        </tbody>
        </table>
</div>


@endsection
