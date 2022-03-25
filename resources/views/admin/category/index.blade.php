@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header ">
        <h4>Categories</h4>
        <a href="{{ route('categories.create')}}" style="float: right" class="btn btn-success btn-sm">Create</a>
    </div>
    <div class="card-body">
       <table class="table">
           <thead>
               <tr class="text-center">
                   <th>Name</th>
                   <th>Status</th>
                   <th>Image</th>
                   <th>Action</th>
               </tr>
           </thead>
           <tbody>
               {{-- @php( $i = 1 ) --}}
               @foreach ($categories as $category)
               <tr class="text-center">
                   <td>{{$category->name}}</td>
                   <td >{{$category->status}}</td>
                   <td>
                       <img src="uploaded/categoryImages/{{$category->image}}" style="width: 70px; height:40px" alt="Category Image">
                   </td>
                   <td>
                       <form action="" method="post">
                           @csrf
                           @method('DELETE')
                           <a href="{{ route('categories.edit', $category->id)}}" class="btn btn-info btn-sm">Edit</a>
                           <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                       </form>
                   </td>
               </tr>
               @endforeach
           </tbody>
       </table>
    </div>
</div>
@endsection