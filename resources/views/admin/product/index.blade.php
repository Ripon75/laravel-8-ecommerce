@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header ">
        <h4>Products</h4>
         <a href="{{route('products.create')}}" style="float: right" class="btn btn-success btn-sm">Create Product</a>
    </div>
    <div class="card-body">
       <table class="table">
           <thead>
               <tr>
                   {{-- <th scope="col">SL No</th> --}}
                   <th scope="col">Name</th>
                   <th scope="col">Category</th>
                   <th scope="col">Slug</th>
                   <th scope="col">Price</th>
                   <th scope="col">Image</th>
                   <th scope="col">Action</th>
               </tr>
           </thead>
           <tbody>
               {{-- @php( $i = 1 ) --}}
               @foreach ($products as $product)
               <tr>
                   <td>{{$product->name}}</td>
                   <td>{{$product->category->name}}</td>
                   <td>{{$product->slug}}</td>
                   <td>{{$product->selling_price}}</td>
                   <td>
                       <img src="uploaded/productImages/{{$product->image}}" style="width: 70px; height:40px" alt="product Image">
                   </td>
                   <td>
                       <form action="" method="post">
                           @csrf
                           @method('DELETE')
                           <a href="{{route('products.edit', $product->id)}}" class="btn btn-info btn-sm">Edit</a>
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