@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        Create Category
    </div>
    <div class="card-body">
        <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="">Name</label>
                    <input type="text" placeholder="Name" class="form-control" name="name">
                </div>

                <div class="col-md-6">
                    <label for="">Slug</label>
                    <input type="text" placeholder="Slug" class="form-control" name="slug">
                </div>

                <div class="col-md-12">
                    <label for="">Description</label>
                    <textarea name="description" rows="3" class="form-control"></textarea>
                </div>

                <div class="col-md-6">
                    <label for="">Status</label>
                    <input type="checkbox" name="status">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Popular</label>
                    <input type="checkbox" name="popular">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" class="form-control" name="meta_title">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Meta Description</label>
                    <input type="text" class="form-control" name="meta_descrip">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Meta Keyword</label>
                    <input type="text" class="form-control" name="meta_keyword">
                </div>

                <div class="col-md-12 mb-3">
                    <label for="">Upload Image</label>
                    <input type="file" class="form-control" name="image">
                </div>

                <div class="col-md-12">
                    <button type="submit" style="float: right" class="btn btn-primary btn-sm mr-10">Submit</button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection