@extends('layouts.app')
@section('main')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-9">
            @include('layouts.message')
            <div class="card border-0 shadow">
                <div class="card-header  text-white">
                    My Reviews
                </div>
                <div class="card-body pb-0">
                    <table class="table  table-striped mt-3" style="text-align: center">
                        <thead class="table-dark">
                            <tr>
                                <th>Book</th>
                                <th>Review</th>
                                <th>Rating</th>
                                <th width="100">Action</th>
                                <th width="150">Share</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($reviews->isNotEmpty())
                            @foreach ($reviews as $review)
                            <tr>
                                <td>{{$review->book->title}}</td>
                                <td>{{$review->review}}</td>
                                <td>{{$review->rating}}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center flex-nowrap"
                                        style="gap: 5px;">
                                        <!-- Edit -->
                                        <a href="{{ route('account.myReviews.edit', $review->review_id) }}"
                                            class="btn btn-primary btn-sm" title="Edit">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>

                                        <!-- Delete -->
                                        <a href="javascript:void(0);" class="btn btn-danger btn-sm"
                                            onclick="deleteMyReview({{ $review->review_id }})" title="Delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center flex-nowrap"
                                        style="gap: 5px;">
                                        <!-- Facebook -->
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('review.share', $review->review_id)) }}"
                                            class="btn btn-outline-primary btn-sm" title="Share on Facebook"
                                            target="_blank">
                                            <i class="fa-brands fa-facebook-f"></i> Facebook
                                        </a>
                                        <!-- WhatsApp -->
                                        <a href="https://api.whatsapp.com/send?text={{ urlencode('My review: "' . $review->review . '"') }}"
                                            class="btn btn-outline-success btn-sm" title="Share on WhatsApp"
                                            target="_blank">
                                            <i class="fa-brands fa-whatsapp"></i> WhatsApp
                                        </a>
                                        <!-- Twitter -->
                                        <a href="https://twitter.com/intent/tweet?text={{ urlencode('My review: "' . $review->review . '" Read it here: ' . route('review.share', $review->review_id)) }}"
                                            class="btn btn-outline-info btn-sm" title="Share on Twitter"
                                            target="_blank">
                                            <i class="fa-brands fa-twitter"></i> Twitter
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5">My Review not found.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                    {{$reviews->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    function deleteMyReview(id){
        if(confirm("Are you sure you want to delete?")){
            $.ajax({
                url: '{{route('account.myReviews.delete')}}',
                data: {
                    _token: '{{ csrf_token() }}',
                    review_id: id
                },
                type: 'post',
                success: function (response) {
                    window.location.href = '{{ route('account.myReviews') }}';
                },
                error: function (xhr) {
                    alert('Something went wrong!');
                }
            });
        }
    }
</script>
@endsection