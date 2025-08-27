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
                <div class="card-header text-white">
                    Reviews
                </div>
                <div class="card-body pb-0">
                    @if($reviews->isNotEmpty())
                    @foreach ($reviews as $review)
                    <div class="review-container mb-4 p-3 border rounded">
                        <!-- Main Review -->
                        <div class="row">
                            <div class="col-md-8">
                                <div class="review-content">
                                    <h6 class="mb-2">
                                        <strong>{{$review->user->name}}</strong>
                                        <span class="text-muted">reviewed</span>
                                        <em>{{$review->book->title}}</em>
                                    </h6>
                                    <div class="mb-2">
                                        <span class="badge bg-warning text-dark">
                                            {{$review->rating}} ⭐
                                        </span>
                                    </div>
                                    <p class="review-text">{{$review->review}}</p>
                                    <small class="text-muted">
                                        {{\Carbon\Carbon::parse($review->created_at)->format('d M Y, h:i A')}}
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-4 text-end">
                                @if($review->user_id == auth()->id())
                                <!-- Own review - can edit/delete -->
                                <a href="{{route('account.reviews.edit',$review->review_id)}}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa-regular fa-pen-to-square"></i> Edit
                                </a>
                                <a href="javascript:void(0);" class="btn btn-danger btn-sm"
                                    onclick="deleteReview({{$review->review_id}})">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </a>
                                @else
                                <!-- Other's review - can only reply -->
                                <button class="btn btn-success btn-sm" onclick="showReplyModal({{$review->review_id}})">
                                    <i class="fa-solid fa-reply"></i> Reply
                                </button>
                                @endif
                                @auth
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                    onclick="openReportModal({{ $review->review_id }})">
                                    <i class="fas fa-flag"></i> Report
                                </button>
                                @endauth
                            </div>
                        </div>

                        <!-- Replies Section -->
                        @if(isset($replies[$review->review_id]) && $replies[$review->review_id]->isNotEmpty())
                        <div class="replies-section mt-3 ms-4">
                            <hr class="my-2">
                            <h6 class="text-primary mb-3">
                                <i class="fa-solid fa-comments"></i>
                                Replies ({{ $replies[$review->review_id]->count() }})
                            </h6>

                            @foreach($replies[$review->review_id] as $reply)
                            <div class="reply-item mb-3 p-3"
                                style="background-color: #f8f9fa; border-left: 3px solid #007bff;">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <strong class="text-primary">{{ $reply->user->name ?? 'Unknown' }}</strong>
                                        <p class="mb-1 mt-1">
                                            <span class="text-muted small">in reply to
                                                <strong>{{ $reply->review->user->name ?? 'Unknown' }}</strong>'s
                                                review</span>
                                        </p>
                                        <p class="mb-1">{{ $reply->message }}</p>
                                    </div>
                                    <!-- Edit Button for Reply Owner -->
                                    @if($reply->user_id == auth()->id())
                                    <div class="ms-2">
                                        <button class="btn btn-outline-primary btn-sm"
                                            onclick="showEditReplyModal({{ $reply->notification_id }}, '{{ str_replace(["
                                            \r", "\n" , "'" , '"' ], ['', '' , "\'" , '\"' ], $reply->message) }}')">
                                            <i class="fa-regular fa-pen-to-square"></i> Edit
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm ms-1"
                                            onclick="deleteReply({{ $reply->notification_id }})">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @endforeach
                    @else
                    <div class="text-center py-5">
                        <i class="fa-regular fa-face-frown fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No Reviews Found</h5>
                    </div>
                    @endif

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $reviews->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reply Modal -->
<div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="replyModalLabel">Reply to Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="replyForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="replyMessage" class="form-label">Your Reply:</label>
                        <textarea class="form-control" id="replyMessage" name="message" rows="4"
                            placeholder="Write your reply here..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-paper-plane"></i> Send Reply
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit Reply Modal -->
<div class="modal fade" id="editReplyModal" tabindex="-1" aria-labelledby="editReplyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editReplyModalLabel">Edit Reply</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editReplyForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editReplyMessage" class="form-label">Edit Your Reply:</label>
                        <textarea class="form-control" id="editReplyMessage" name="message" rows="4"
                            placeholder="Edit your reply here..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Update Reply
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Report Modal -->
<div class="modal fade" id="reportModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Report Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('account.report.submit') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="review_id" id="report_review_id">

                    <div class="mb-3">
                        <label class="form-label">Report Reason:</label>
                        <select name="reason" class="form-select" required>
                            <option value="">Select reason...</option>
                            <option value="Spam">Spam Content</option>
                            <option value="Inappropriate Language">Inappropriate Language</option>
                            <option value="Fake Review">Fake Review</option>
                            <option value="Offensive Content">Offensive Content</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="text-muted small">
                        <strong>Note:</strong> False reports may result in account restrictions.
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger btn-sm">
                        Submit Report
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .review-container {
        transition: all 0.3s ease;
    }

    .review-container:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .reply-item {
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .reply-item:hover {
        background-color: #e3f2fd !important;
    }
</style>
@endsection

@section('script')
<script>
    function deleteReview(id)
    {
        if(confirm("Are you sure you want to delete?")){
            $.ajax({
                url: '{{route('account.reviews.deleteReview')}}',
                data: {
                    _token: '{{ csrf_token() }}',
                    review_id: id
                },
                type: 'post',
                success: function (response) {
                    window.location.href = '{{ route('account.reviews') }}';
                },
                error: function (xhr) {
                    alert('Something went wrong!');
                }
            });
        }
    }

    function showReplyModal(reviewId) {
        $('#replyForm').attr('action', '{{ route("account.reviews.reply", ":reviewId") }}'.replace(':reviewId', reviewId));
        $('#replyModal').modal('show');
    }

    // Reply form submission
    $('#replyForm').on('submit', function(e) {
        e.preventDefault();
        
        var submitBtn = $(this).find('button[type="submit"]');
        var originalText = submitBtn.html();
        
        // Show loading
        submitBtn.html('<i class="fa-solid fa-spinner fa-spin"></i> Sending...').prop('disabled', true);
        
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#replyModal').modal('hide');
                $('#replyMessage').val('');
                
                // Show success message and reload page to show new reply
                if(response.success) {
                    alert('Reply sent successfully! Email notification has been sent.');
                } else {
                    alert('Reply sent successfully!');
                }
                
                // Reload page to show the new reply
                location.reload();
            },
            error: function(xhr) {
                alert('Error sending reply! Please try again.');
                // Reset button
                submitBtn.html(originalText).prop('disabled', false);
            }
        });
    });

    // Clear form when modal is closed
    $('#replyModal').on('hidden.bs.modal', function () {
        $('#replyMessage').val('');
        $('#replyForm').find('button[type="submit"]').html('<i class="fa-solid fa-paper-plane"></i> Send Reply').prop('disabled', false);
    });



    // New function for Edit Reply Modal
    function showEditReplyModal(replyId, currentMessage) {
        $('#editReplyForm').attr('action', '{{ route("account.reviews.updateReply", ":replyId") }}'.replace(':replyId', replyId));
        $('#editReplyMessage').val(currentMessage);
        $('#editReplyModal').modal('show');
    }

    
    // Edit Reply form submission
    $('#editReplyForm').on('submit', function(e) {
        e.preventDefault();
        
        var submitBtn = $(this).find('button[type="submit"]');
        var originalText = submitBtn.html();
        
        // Show loading
        submitBtn.html('<i class="fa-solid fa-spinner fa-spin"></i> Updating...').prop('disabled', true);
        
        $.ajax({
            url: $(this).attr('action'),
            method: 'PUT',
            data: $(this).serialize(),
            success: function(response) {
                $('#editReplyModal').modal('hide');
                
                if(response.success) {
                    alert('Reply updated successfully!');
                } else {
                    alert('Reply updated successfully!');
                }
                
                // Reload page to show updated reply
                location.reload();
            },
            error: function(xhr) {
                alert('Error updating reply! Please try again.');
                // Reset button
                submitBtn.html(originalText).prop('disabled', false);
            }
        });
    });
    // Clear form when edit reply modal is closed
    $('#editReplyModal').on('hidden.bs.modal', function () {
        $('#editReplyMessage').val('');
        $('#editReplyForm').find('button[type="submit"]').html('<i class="fa-solid fa-save"></i> Update Reply').prop('disabled', false);
    });


    //This method is used to delete the reply which is assign on the user`s review:
    function deleteReply(replyId)
    {
        if(confirm("Are you sure you want to delete this reply?")){
            $.ajax({
                url: '{{route('account.reviews.deleteReply')}}',
                data: {
                    _token: '{{ csrf_token() }}',
                    reply_id: replyId
                },
                type: 'post',
                success: function (response) {
                    if(response.success) {
                        alert('Reply deleted successfully!');
                        location.reload();
                    } else {
                        alert('Reply deleted successfully!');
                        location.reload();
                    }
                },
                error: function (xhr) {
                    alert('Error deleting reply! Please try again.');
                }
            });
        }
    }

    function openReportModal(review_id) {
        document.getElementById('report_review_id').value = review_id;
        new bootstrap.Modal(document.getElementById('reportModal')).show();
    }
</script>
@endsection