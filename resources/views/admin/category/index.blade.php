@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header ">
        <h4>Category</h4>
         <a href="{{route('category.create')}}" style="float: right" class="btn btn-success btn-sm">Create Category</a>
    </div>
    <div class="card-body">
       <table class="table">
           <thead>
               <tr>
                   {{-- <th scope="col">SL No</th> --}}
                   <th scope="col">Name</th>
                   <th scope="col">Slug</th>
                   <th scope="col">Image</th>
                   <th scope="col">Action</th>
               </tr>
           </thead>
           <tbody>
               {{-- @php( $i = 1 ) --}}
               @foreach ($categories as $category)
               <tr>
                   <td>{{$category->name}}</td>
                   <td>{{$category->slug}}</td>
                   <td>
                       <img src="uploaded/categoryImages/{{$category->image}}" style="width: 70px; height:40px" alt="Category Image">
                   </td>
                   <td>
                       <form action="" method="post">
                           @csrf
                           @method('DELETE')
                           <a href="{{route('category.edit', $category->id)}}" class="btn btn-info btn-sm">Edit</a>
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