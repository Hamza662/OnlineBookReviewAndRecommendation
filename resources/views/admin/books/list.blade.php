@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    @include('admin.layouts.message')
    <div class="card"
        style="border: none; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-radius: 8px; background: #fff;">
        <div class="card-header"
            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 8px 8px 0 0; padding: 15px 20px; font-size: 18px; font-weight: 600; border: none;">
            📚 Books Management
        </div>
        <div class="card-body" style="padding: 25px 20px 0;">
            <div
                style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px; flex-wrap: wrap; gap: 15px;">
                <a href="{{route('admin.books.create')}}" class="btn btn-primary"
                    style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); border: none; padding: 10px 20px; border-radius: 6px; font-weight: 500; text-decoration: none; color: white; transition: all 0.3s ease; box-shadow: 0 2px 4px rgba(40, 167, 69, 0.3);"
                    onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.2)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(40, 167, 69, 0.3)';">
                    ➕ Add New Book
                </a>

                <form action="" style="margin: 0;">
                    <div style="display: flex; gap: 8px; align-items: center;">
                        <input type="text" class="form-control" name="keyword" value="{{Request::get('keyword')}}"
                            placeholder="🔍 Search By Title, Author, Genre"
                            style="border: 2px solid #e9ecef; border-radius: 6px; padding: 8px 15px; width: 280px; transition: all 0.3s ease; outline: none; font-size: 14px;"
                            onfocus="this.style.borderColor='#007bff'; this.style.boxShadow='0 0 0 0.2rem rgba(0, 123, 255, 0.25)';"
                            onblur="this.style.borderColor='#e9ecef'; this.style.boxShadow='none';">
                        <button type="submit" class="btn btn-primary"
                            style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); border: none; padding: 8px 16px; border-radius: 6px; font-weight: 500; color: white; transition: all 0.3s ease;"
                            onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.2)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                            Search
                        </button>
                        <a href="{{route('admin.books.index')}}" class="btn btn-secondary"
                            style="background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%); border: none; padding: 8px 16px; border-radius: 6px; font-weight: 500; color: white; text-decoration: none; transition: all 0.3s ease;"
                            onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.2)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                            Clear
                        </a>
                    </div>
                </form>
            </div>

            <div style="overflow-x: auto; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                @if($books->isNotEmpty())
                <table class="table"
                    style="margin: 0; background: white; border-collapse: separate; border-spacing: 0;">
                    <thead style="background: linear-gradient(135deg, #343a40 0%, #495057 100%); color: white;">
                        <tr>
                            <th
                                style="padding: 15px 12px; text-align: center; font-weight: 600; border: none; font-size: 14px; letter-spacing: 0.5px;">
                                📖 Title
                            </th>
                            <th
                                style="padding: 15px 12px; text-align: center; font-weight: 600; border: none; font-size: 14px; letter-spacing: 0.5px;">
                                ✍️ Author
                            </th>
                            <th
                                style="padding: 15px 12px; text-align: center; font-weight: 600; border: none; font-size: 14px; letter-spacing: 0.5px;">
                                🏷️ Genre
                            </th>
                            <th
                                style="padding: 15px 12px; text-align: center; font-weight: 600; border: none; font-size: 14px; letter-spacing: 0.5px;">
                                🖼️ Cover
                            </th>
                            <th
                                style="padding: 15px 12px; text-align: center; font-weight: 600; border: none; font-size: 14px; letter-spacing: 0.5px;">
                                ⚙️ Actions
                            </th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach($books as $book)
                        <tr style="border-bottom: 1px solid #dee2e6; transition: all 0.3s ease;"
                            onmouseover="this.style.backgroundColor='#f8f9fa'"
                            onmouseout="this.style.backgroundColor='white'">
                            <td
                                style="padding: 15px 12px; text-align: center; vertical-align: middle; font-weight: 500; color: #495057;">
                                {{ $book->title }}
                            </td>
                            <td
                                style="padding: 15px 12px; text-align: center; vertical-align: middle; color: #6c757d; font-style: italic;">
                                {{ $book->author }}
                            </td>
                            <td style="padding: 15px 12px; text-align: center; vertical-align: middle;">
                                @foreach ($book->genres as $g)
                                <span
                                    style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); color: white; padding: 4px 10px; border-radius: 15px; font-size: 12px; font-weight: 500; margin: 2px; display: inline-block; box-shadow: 0 1px 3px rgba(23, 162, 184, 0.3);">
                                    {{ $g->genre_name }}
                                </span>
                                @endforeach
                            </td>
                            <td style="padding: 15px 12px; text-align: center; vertical-align: middle;">
                                @if($book->cover_img)
                                <img src="{{ asset('uploads/books/thumb/' . $book->cover_img) }}"
                                    style="width: 50px; height: 70px; object-fit: cover; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border: 2px solid #e9ecef;"
                                    alt="Book Cover">
                                @else
                                <div
                                    style="width: 50px; height: 70px; background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%); border-radius: 4px; display: inline-flex; align-items: center; justify-content: center; color: #6c757d; font-size: 12px; border: 2px solid #dee2e6;">
                                    No Image
                                </div>
                                @endif
                            </td>
                            <td style="padding: 15px 12px; text-align: center; vertical-align: middle;">
                                <div style="display: flex; gap: 5px; justify-content: center; align-items: center;">
                                    <a href="{{route('admin.books.show', $book->book_id)}}"
                                        style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); color: white; padding: 6px 10px; border-radius: 4px; text-decoration: none; font-size: 12px; transition: all 0.3s ease; box-shadow: 0 1px 3px rgba(40, 167, 69, 0.3);"
                                        title="View Details"
                                        onmouseover="this.style.background='linear-gradient(135deg, #20c997 0%, #17a2b8 100%)'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.2)';"
                                        onmouseout="this.style.background='linear-gradient(135deg, #28a745 0%, #20c997 100%)'; this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(40, 167, 69, 0.3)';">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{route('admin.books.edit',$book->book_id)}}"
                                        style="background: linear-gradient(135deg, #007bff 0%, #0056b3 100%); color: white; padding: 6px 10px; border-radius: 4px; text-decoration: none; font-size: 12px; transition: all 0.3s ease; box-shadow: 0 1px 3px rgba(0, 123, 255, 0.3);"
                                        title="Edit Book"
                                        onmouseover="this.style.background='linear-gradient(135deg, #0056b3 0%, #004085 100%)'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.2)';"
                                        onmouseout="this.style.background='linear-gradient(135deg, #007bff 0%, #0056b3 100%)'; this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0, 123, 255, 0.3)';"
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <a href="javascript:void(0);" onclick="deleteBook({{$book->book_id}});"
                                        style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); color: white; padding: 6px 10px; border-radius: 4px; text-decoration: none; font-size: 12px; transition: all 0.3s ease; box-shadow: 0 1px 3px rgba(220, 53, 69, 0.3); cursor: pointer;"
                                        title="Delete Book"
                                        onmouseover="this.style.background='linear-gradient(135deg, #c82333 0%, #a71e2a 100%)'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(0,0,0,0.2)';"
                                        onmouseout="this.style.background='linear-gradient(135deg, #dc3545 0%, #c82333 100%)'; this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(220, 53, 69, 0.3)';">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div style="text-align: center; font-size: 30px">No book found.</div>
                @endif
                
            </div>

            @if($books->isNotEmpty())
            <div style="margin-top: 25px; display: flex; justify-content: center;">
                <div
                    style="background: white; padding: 10px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    {{$books->links()}}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('java_script')
<script>
    function deleteBook(id) {
        // Custom styled confirmation dialog
        if (confirm("🚨 Are you sure you want to delete this book?\n\nThis action cannot be undone!")) {
            // Show loading state
            const deleteBtn = event.target.closest('a');
            const originalContent = deleteBtn.innerHTML;
            deleteBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
            deleteBtn.style.pointerEvents = 'none';
            
            $.ajax({
                url: `/admin/books/${id}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}',
                    force_delete: true
                },
                success: function (response) {
                    // Success animation
                    deleteBtn.style.background = 'linear-gradient(135deg, #28a745 0%, #20c997 100%)';
                    deleteBtn.innerHTML = '<i class="fa fa-check"></i>';
                    
                    setTimeout(() => {
                        window.location.href = '{{ route('admin.books.index') }}';
                    }, 500);
                },
                error: function (xhr) {
                    // Reset button on error
                    deleteBtn.innerHTML = originalContent;
                    deleteBtn.style.pointerEvents = 'auto';
                    
                    alert('❌ Something went wrong! Please try again.');
                }
            });
        }
    }

    // Add loading animation to search
    document.querySelector('form').addEventListener('submit', function() {
        const searchBtn = this.querySelector('button[type="submit"]');
        const originalContent = searchBtn.innerHTML;
        searchBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Searching...';
        searchBtn.disabled = true;
    });
</script>
@endsection