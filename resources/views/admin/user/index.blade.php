@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header ">
        <h4>Products</h4>
         <a href="{{route('products.create')}}" class="btn btn-success btn-sm float-end">Create</a>
    </div>
    <div class="card-body">
       <table class="table">
           <thead>
               <tr>
                   {{-- <th scope="col">SL No</th> --}}
                   <th>Name</th>
                   <th>Email</th>
                   <th>Phone</th>
                   <th>Action</th>
               </tr>
           </thead>
           <tbody>
               {{-- @php( $i = 1 ) --}}
               @foreach ($users as $user)
               <tr>
                   <td>{{$user->name}}</td>
                   <td>{{$user->email}}</td>
                   <td>{{$user->phone}}</td>
                   <td>
                       <form action="" method="post">
                           @csrf
                           @method('DELETE')
                           <a href="" class="btn btn-info btn-sm">Edit</a>
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