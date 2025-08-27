@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper"
    style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); min-height: 100vh; padding: 30px;">
    <div class="container-fluid">
        {{-- @include('layouts.message') --}}

        <!-- Beautiful Header Card -->
        <div
            style="background: rgba(255,255,255,0.95); border-radius: 25px; padding: 30px; margin-bottom: 30px; box-shadow: 0 20px 60px rgba(0,0,0,0.1); backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.2);">
            <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div
                        style="width: 60px; height: 60px; background: linear-gradient(135deg, #6c757d, #495057); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 30px rgba(108, 117, 125, 0.3);">
                        <i class="fas fa-star" style="font-size: 24px; color: #ffd700;"></i>
                    </div>
                    <div>
                        <h1
                            style="margin: 0; font-size: 2.2rem; font-weight: 700; background: linear-gradient(135deg, #6c757d, #495057); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                            Reviews Dashboard
                        </h1>
                        <p style="margin: 0; color: #6c757d; font-size: 1.1rem; font-weight: 400;">
                            All Users reviews and ratings
                        </p>
                    </div>
                </div>
                <div
                    style="background: linear-gradient(135deg, #6c757d, #495057); color: white; padding: 15px 25px; border-radius: 50px; font-weight: 600; font-size: 1rem; box-shadow: 0 10px 30px rgba(108, 117, 125, 0.3);">
                    {{ $reviews->count() }} Reviews
                </div>
            </div>
        </div>

        @if($reviews->isNotEmpty())
        <!-- Reviews Table Container -->
        <div
            style="background: rgba(255,255,255,0.95); border-radius: 25px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.1); backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.2);">

            <!-- Table Header -->
            <div style="background: linear-gradient(135deg, #6c757d, #495057); color: white; padding: 20px;">
                <h3 style="margin: 0; font-weight: 600; font-size: 1.3rem;">
                    <i class="fas fa-comments" style="margin-right: 10px;"></i>
                    Customer Reviews
                </h3>
            </div>

            <!-- Reviews Table -->
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; background: white; table-layout: fixed;">
                    <thead>
                        <tr
                            style="background: linear-gradient(135deg, #f8f9fa, #e9ecef); border-bottom: 2px solid #dee2e6;">
                            <th
                                style="width: 180px; padding: 20px; text-align: left; font-weight: 600; color: #495057; font-size: 1rem; border-right: 1px solid #dee2e6;">
                                <i class="fas fa-user" style="margin-right: 8px; color: #6c757d;"></i>
                                User
                            </th>
                            <th
                                style="width: 200px; padding: 20px; text-align: left; font-weight: 600; color: #495057; font-size: 1rem; border-right: 1px solid #dee2e6;">
                                <i class="fas fa-book" style="margin-right: 8px; color: #6c757d;"></i>
                                Book
                            </th>
                            <th
                                style="width: 350px; padding: 20px; text-align: left; font-weight: 600; color: #495057; font-size: 1rem; border-right: 1px solid #dee2e6;">
                                <i class="fas fa-comment" style="margin-right: 8px; color: #6c757d;"></i>
                                Review & Replies
                            </th>
                            <th
                                style="width: 120px; padding: 20px; text-align: center; font-weight: 600; color: #495057; font-size: 1rem; border-right: 1px solid #dee2e6;">
                                <i class="fas fa-star" style="margin-right: 8px; color: #ffd700;"></i>
                                Rating
                            </th>
                            <th
                                style="width: 120px; padding: 20px; text-align: center; font-weight: 600; color: #495057; font-size: 1rem; border-right: 1px solid #dee2e6;">
                                <i class="fas fa-calendar" style="margin-right: 8px; color: #6c757d;"></i>
                                Date
                            </th>
                            {{-- <th
                                style="width: 100px; padding: 20px; text-align: center; font-weight: 600; color: #495057; font-size: 1rem; border-right: 1px solid #dee2e6;">
                                <i class="fas fa-info-circle" style="margin-right: 8px; color: #6c757d;"></i>
                                Status
                            </th> --}}
                            <th
                                style="width: 150px; padding: 20px; text-align: center; font-weight: 600; color: #495057; font-size: 1rem;">
                                <i class="fas fa-cog" style="margin-right: 8px; color: #6c757d;"></i>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $index => $review)
                        <tr style="border-bottom: 1px solid #f8f9fa; transition: all 0.3s ease; {{ $index % 2 == 0 ? 'background: #fefefe;' : 'background: white;' }}"
                            onmouseover="this.style.backgroundColor='#f8f9fa'; this.style.transform='scale(1.01)'"
                            onmouseout="this.style.backgroundColor='{{ $index % 2 == 0 ? '#fefefe' : 'white' }}'; this.style.transform='scale(1)'">

                            <!-- User Column -->
                            <td style="padding: 20px; border-right: 1px solid #f8f9fa;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div
                                        style="width: 40px; height: 40px; background: linear-gradient(135deg, #6c757d, #495057); border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3); flex-shrink: 0;">
                                        <span style="color: white; font-weight: 700; font-size: 0.9rem;">
                                            {{ strtoupper(substr($review->user->name, 0, 2)) }}
                                        </span>
                                    </div>
                                    <div style="flex: 1; min-width: 0;">
                                        <div
                                            style="color: #2d3748; font-size: 0.95rem; font-weight: 600; margin-bottom: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            {{ $review->user->name }}
                                        </div>
                                        <div style="color: #6c757d; font-size: 0.8rem; white-space: nowrap;">
                                            Reviewer
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <!-- Book Column -->
                            <td style="padding: 20px; border-right: 1px solid #f8f9fa;">
                                <div
                                    style="background: linear-gradient(135deg, #f8f9fa, #e9ecef); padding: 12px 15px; border-radius: 10px; border-left: 3px solid #6c757d; min-height: 50px; display: flex; align-items: center;">
                                    <div
                                        style="color: #2d3748; font-size: 0.95rem; font-weight: 600; line-height: 1.4; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                        {{ $review->book->title }}
                                    </div>
                                </div>
                            </td>

                            <!-- Review Column -->
                            <td style="padding: 20px; border-right: 1px solid #f8f9fa;">
                                <div
                                    style="background: linear-gradient(135deg, #f8f9fa, #e9ecef); padding: 15px; border-radius: 10px; border-left: 3px solid #28a745; margin-bottom: 15px;">
                                    <p
                                        style="margin: 0; line-height: 1.6; color: #2d3748; font-size: 0.9rem; font-style: italic; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                                        "{{ $review->review }}"
                                    </p>
                                </div>

                                <!-- Replies in Table -->
                                @if(isset($replies[$review->review_id]) && $replies[$review->review_id]->count() > 0)
                                <div style="max-height: 150px; overflow-y: auto; padding-right: 5px;"
                                    class="reply-scroll">
                                    <div
                                        style="background: linear-gradient(135deg, #e6f3ff, #cce7ff); padding: 8px 12px; border-radius: 8px; margin-bottom: 8px; border-left: 3px solid #007bff;">
                                        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 5px;">
                                            <i class="fas fa-reply" style="color: #007bff; font-size: 12px;"></i>
                                            <span style="color: #495057; font-size: 0.8rem; font-weight: 600;">{{
                                                $replies[$review->review_id]->count() }} Replies</span>
                                        </div>
                                    </div>

                                    @foreach($replies[$review->review_id] as $reply)
                                    <div
                                        style="background: linear-gradient(135deg, #f0f8ff, #e6f3ff); border-radius: 8px; padding: 10px; margin-bottom: 8px; border-left: 2px solid #007bff; position: relative;">
                                        <div style="display: flex; align-items: flex-start; gap: 8px;">
                                            <div
                                                style="width: 24px; height: 24px; background: linear-gradient(135deg, #007bff, #0056b3); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                <span style="color: white; font-weight: 700; font-size: 0.7rem;">
                                                    {{ strtoupper(substr($reply->user->name, 0, 2)) }}
                                                </span>
                                            </div>
                                            <div style="flex: 1; min-width: 0;">
                                                <div
                                                    style="display: flex; align-items: center; gap: 6px; margin-bottom: 4px;">
                                                    <strong
                                                        style="color: #2d3748; font-size: 0.8rem; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{
                                                        $reply->user->name }}</strong>
                                                    <span
                                                        style="color: #6c757d; font-size: 0.7rem; background: #dee2e6; padding: 1px 6px; border-radius: 4px;">Reply</span>
                                                </div>
                                                <p
                                                    style="margin: 0; color: #495057; font-size: 0.8rem; line-height: 1.4; word-wrap: break-word; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                                    {{ $reply->message }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </td>

                            <!-- Rating Column -->
                            <td style="padding: 20px; border-right: 1px solid #f8f9fa; text-align: center;">
                                <div
                                    style="display: inline-flex; align-items: center; gap: 8px; background: linear-gradient(135deg, #fff5cd, #fef5e7); padding: 10px 12px; border-radius: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); white-space: nowrap;">
                                    <div style="display: flex; gap: 2px;">
                                        @for($i = 1; $i <= 5; $i++) <i class="fas fa-star"
                                            style="color: {{ $i <= $review->rating ? '#ffd700' : '#e2e8f0' }}; font-size: 12px;">
                                            </i>
                                            @endfor
                                    </div>
                                    <span style="font-weight: 700; color: #d69e2e; font-size: 0.9rem;">{{$review->rating}}</span>
                                </div>
                            </td>
                            <!-- Date Column -->
                            <td style="padding: 20px; border-right: 1px solid #f8f9fa; text-align: center;">
                                <div
                                    style="background: linear-gradient(135deg, #e6fffa, #f0fff4); padding: 10px 12px; border-radius: 10px; display: inline-block; white-space: nowrap; min-width: 80px;">
                                    <div
                                        style="color: #2d3748; font-size: 0.85rem; font-weight: 600; line-height: 1.2;">
                                        {{ \Carbon\Carbon::parse($review->created_at)->format('d M') }}
                                    </div>
                                    <div style="color: #6c757d; font-size: 0.75rem; margin-top: 2px;">
                                        {{ \Carbon\Carbon::parse($review->created_at)->format('Y') }}
                                    </div>
                                </div>
                            </td>

                            <!-- Status Column -->
                            {{-- <td style="padding: 20px; border-right: 1px solid #f8f9fa; text-align: center;">
                                <div
                                    style="background: linear-gradient(135deg, #d4edda, #c3e6cb); color: #155724; padding: 8px 12px; border-radius: 15px; font-size: 0.8rem; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; white-space: nowrap;">
                                    <i class="fas fa-check-circle" style="font-size: 11px;"></i>
                                    Active
                                </div>
                            </td> --}}

                            <!-- Actions Column -->
                            <td style="padding: 20px; text-align: center;">
                                <div style="display: flex; gap: 6px; justify-content: center; flex-wrap: wrap;">
                                    @if(auth()->user()->role == 'admin')
                                    <button onclick="toggleReviewDetails({{ $review->review_id }})"
                                        style="background: linear-gradient(135deg, #6c757d, #495057); color: white; padding: 8px 12px; border-radius: 8px; border: none; font-size: 0.8rem; font-weight: 600; display: flex; align-items: center; gap: 6px; cursor: pointer; box-shadow: 0 3px 10px rgba(108, 117, 125, 0.3); transition: all 0.3s ease; white-space: nowrap; min-width: 60px; justify-content: center;"
                                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(108, 117, 125, 0.4)'"
                                        onmouseout="this.style.transform='translateY(0px)'; this.style.boxShadow='0 3px 10px rgba(108, 117, 125, 0.3)'">
                                        <i class="fas fa-eye" style="font-size: 11px;"></i>
                                        <span class="btn-text">View</span>
                                    </button>
                                    <button onclick="deleteReview({{$review->review_id}})"
                                        style="background: linear-gradient(135deg, #dc3545, #c82333); color: white; padding: 8px 12px; border-radius: 8px; border: none; font-size: 0.8rem; font-weight: 600; display: flex; align-items: center; gap: 6px; cursor: pointer; box-shadow: 0 3px 10px rgba(220, 53, 69, 0.3); transition: all 0.3s ease; white-space: nowrap; min-width: 60px; justify-content: center;"
                                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(220, 53, 69, 0.4)'"
                                        onmouseout="this.style.transform='translateY(0px)'; this.style.boxShadow='0 3px 10px rgba(220, 53, 69, 0.3)'">
                                        <i class="fa-solid fa-trash" style="font-size: 11px;"></i>
                                        <span class="btn-text">Delete</span>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Expandable Review Details Row -->
                        <tr id="review-details-{{ $review->review_id }}" style="display: none; background: #f8f9fa;">
                            <td colspan="7" style="padding: 0; border-bottom: 1px solid #dee2e6;">
                                <div style="padding: 25px; background: linear-gradient(135deg, #f8f9fa, #e9ecef);">

                                    <!-- Full Review Text -->
                                    <div
                                        style="background: white; padding: 20px; border-radius: 15px; margin-bottom: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border-left: 4px solid #6c757d;">
                                        <h6
                                            style="color: #495057; font-weight: 600; margin-bottom: 15px; font-size: 1.1rem;">
                                            <i class="fas fa-quote-left" style="margin-right: 8px; color: #6c757d;"></i>
                                            Full Review
                                        </h6>
                                        <p
                                            style="margin: 0; line-height: 1.7; color: #2d3748; font-size: 1rem; font-style: italic;">
                                            "{{ $review->review }}"
                                        </p>
                                    </div>

                                    <!-- Replies Section -->
                                    @if(isset($replies[$review->review_id]) && $replies[$review->review_id]->count() >
                                    0)
                                    <div
                                        style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border-left: 4px solid #28a745;">
                                        <h6
                                            style="color: #495057; font-weight: 600; margin-bottom: 20px; font-size: 1.1rem;">
                                            <i class="fas fa-reply" style="margin-right: 8px; color: #28a745;"></i>
                                            Replies ({{ $replies[$review->review_id]->count() }})
                                        </h6>

                                        <div style="display: grid; gap: 15px;">
                                            @foreach($replies[$review->review_id] as $reply)
                                            <div
                                                style="background: #f8f9fa; border-radius: 12px; padding: 15px; margin-left: 20px; position: relative; border-left: 3px solid #28a745;">
                                                <div style="display: flex; align-items: flex-start; gap: 12px;">
                                                    <div
                                                        style="width: 32px; height: 32px; background: linear-gradient(135deg, #28a745, #20c997); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                        <span
                                                            style="color: white; font-weight: 700; font-size: 0.75rem;">
                                                            {{ strtoupper(substr($reply->user->name, 0, 2)) }}
                                                        </span>
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <div
                                                            style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
                                                            <strong
                                                                style="color: #2d3748; font-size: 0.9rem; font-weight: 600;">{{
                                                                $reply->user->name }}</strong>
                                                            <span
                                                                style="color: #6c757d; font-size: 0.8rem; background: #e9ecef; padding: 2px 8px; border-radius: 6px;">Reply</span>
                                                        </div>
                                                        <p
                                                            style="margin: 0; color: #495057; font-size: 0.9rem; line-height: 1.5;">
                                                            {{ $reply->message }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div style="margin-top: 40px; display: flex; justify-content: center;">
            <div
                style="background: rgba(255,255,255,0.95); border-radius: 20px; padding: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.08); backdrop-filter: blur(10px);">
                {{ $reviews->links() }}
            </div>
        </div>

        @else
        <!-- Empty State -->
        <div
            style="background: rgba(255,255,255,0.95); border-radius: 25px; padding: 80px 40px; text-align: center; box-shadow: 0 20px 60px rgba(0,0,0,0.1); backdrop-filter: blur(15px);">
            <div style="margin-bottom: 30px;">
                <i class="fas fa-comments" style="font-size: 5rem; color: #cbd5e0;"></i>
            </div>
            <h3 style="color: #2d3748; font-weight: 700; margin-bottom: 15px; font-size: 2rem;">No Reviews Found</h3>
            <p style="color: #6c757d; font-size: 1.2rem; max-width: 500px; margin: 0 auto 40px; line-height: 1.6;">
                There are no reviews to display at the moment. Reviews will appear here once customers start sharing
                their thoughts about books.
            </p>
            <div
                style="display: inline-block; background: linear-gradient(135deg, #6c757d, #495057); color: white; padding: 15px 30px; border-radius: 50px; font-weight: 600; font-size: 1.1rem; box-shadow: 0 10px 30px rgba(108, 117, 125, 0.3);">
                <i class="fas fa-clock" style="margin-right: 10px;"></i>
                Waiting for Reviews
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Custom Styles -->
<style>
    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin: 0;
    }

    .pagination .page-item .page-link {
        background: linear-gradient(135deg, #6c757d, #495057);
        border: none;
        color: white;
        padding: 12px 18px;
        border-radius: 15px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
    }

    .pagination .page-item .page-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #495057, #6c757d);
        box-shadow: 0 8px 25px rgba(108, 117, 125, 0.4);
    }

    .pagination .page-item.disabled .page-link {
        background: #e2e8f0;
        color: #a0aec0;
        box-shadow: none;
    }

    /* Custom Scrollbar for Reply Section */
    .reply-scroll::-webkit-scrollbar {
        width: 4px;
    }

    .reply-scroll::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 2px;
    }

    .reply-scroll::-webkit-scrollbar-thumb {
        background: #007bff;
        border-radius: 2px;
    }

    .reply-scroll::-webkit-scrollbar-thumb:hover {
        background: #0056b3;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .content-wrapper {
            padding: 15px !important;
        }

        table {
            font-size: 0.85rem;
        }

        th,
        td {
            padding: 12px 8px !important;
        }

        .pagination .page-item .page-link {
            padding: 8px 12px;
            font-size: 0.9rem;
        }

        /* Hide button text on mobile, show only icons */
        .btn-text {
            display: none;
        }

        button {
            min-width: 40px !important;
            padding: 8px !important;
        }
    }

    @media (max-width: 1200px) {

        /* Adjust table widths for medium screens */
        th:nth-child(1),
        td:nth-child(1) {
            width: 150px;
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 180px;
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 300px;
        }

        th:nth-child(4),
        td:nth-child(4) {
            width: 100px;
        }

        th:nth-child(5),
        td:nth-child(5) {
            width: 100px;
        }

        th:nth-child(6),
        td:nth-child(6) {
            width: 80px;
        }

        th:nth-child(7),
        td:nth-child(7) {
            width: 120px;
        }
    }
</style>
@endsection

@section('java_script')
<script>
    function showNotification(message, type = 'success') {
        const color = type === 'success' ? 'linear-gradient(135deg, #28a745, #20c997)' : 'linear-gradient(135deg, #dc3545, #c82333)';
        const icon = type === 'success' ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';
        
        const div = document.createElement('div');
        div.innerHTML = `<i class="${icon}" style="margin-right: 10px;"></i>${message}`;
        div.style.position = 'fixed';
        div.style.top = '30px';
        div.style.right = '30px';
        div.style.padding = '15px 25px';
        div.style.background = color;
        div.style.color = '#fff';
        div.style.borderRadius = '15px';
        div.style.boxShadow = '0 10px 30px rgba(0,0,0,0.2)';
        div.style.zIndex = '99999';
        div.style.fontSize = '1rem';
        div.style.fontWeight = '600';
        div.style.backdropFilter = 'blur(10px)';
        div.style.animation = 'slideIn 0.3s ease';
        
        document.body.appendChild(div);

        setTimeout(() => {
            div.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => div.remove(), 300);
        }, 3000);
    }

    function toggleReviewDetails(reviewId) {
        const detailsRow = document.getElementById(`review-details-${reviewId}`);
        if (detailsRow.style.display === 'none' || detailsRow.style.display === '') {
            detailsRow.style.display = 'table-row';
            detailsRow.style.animation = 'fadeIn 0.3s ease';
        } else {
            detailsRow.style.animation = 'fadeOut 0.3s ease';
            setTimeout(() => {
                detailsRow.style.display = 'none';
            }, 300);
        }
    }

    function deleteReview(id) {
        const confirmDelete = confirm("🗑️ Are you sure you want to delete this review?\n\n⚠️ This action cannot be undone and will remove all replies as well!");
        
        if (confirmDelete) {
            const deleteButton = document.querySelector(`button[onclick="deleteReview(${id})"]`);
            
            if (deleteButton) {
                deleteButton.style.pointerEvents = 'none';
                deleteButton.style.opacity = '0.7';
                deleteButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
            }

            $.ajax({
                url: '{{ route("admin.admin.admin.deleteReview") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    review_id: id
                },
                success: function(response) {
                    if (response.status) {
                        showNotification('✅ Review deleted successfully!', 'success');
                        
                        const reviewRow = deleteButton.closest('tr');
                        if (reviewRow) {
                            reviewRow.style.transition = 'all 0.5s ease';
                            reviewRow.style.transform = 'translateX(-100%)';
                            reviewRow.style.opacity = '0';
                        }
                        
                        setTimeout(() => {
                            window.location.reload();
                        }, 800);
                    } else {
                        showNotification('❌ ' + (response.message || 'Failed to delete review'), 'error');
                        if (deleteButton) {
                            deleteButton.style.pointerEvents = 'auto';
                            deleteButton.style.opacity = '1';
                            deleteButton.innerHTML = '<i class="fa-solid fa-trash"></i> Delete';
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Delete Error:', error);
                    showNotification('❌ Something went wrong! Please try again.', 'error');
                    
                    if (deleteButton) {
                        deleteButton.style.pointerEvents = 'auto';
                        deleteButton.style.opacity = '1';
                        deleteButton.innerHTML = '<i class="fa-solid fa-trash"></i> Delete';
                    }
                }
            });
        }
    }
</script>

{{-- <style>
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }

        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: translateY(0);
        }

        to {
            opacity: 0;
            transform: translateY(-10px);
        }
    }
</style> --}}
@endsection