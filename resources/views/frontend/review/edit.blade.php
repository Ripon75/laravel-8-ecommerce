@extends('layouts.frontend')

{{-- @section('title', 'Edit your review')
    
@endsection --}}

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>You are written a review for {{ $review->product->name }}</h5>
                    <form action="{{ url('/update-review') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="review_id" value="{{ $review->id }}">
                        <textarea class="form-control mt-3" name="user_review" rows="5">{{ $review->review }}</textarea>
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection