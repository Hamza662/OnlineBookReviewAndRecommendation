@extends('layouts.app')

@section('main')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>My Wishlists</h2>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createWishlistModal">
                    <i class="fas fa-plus"></i> Create New Wishlist
                </button>
            </div>

            @if($wishlists->count() > 0)
            <div class="row">
                @foreach($wishlists as $wishlist)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $wishlist->name }}</h5>
                            <p class="card-text text-muted">
                                <small>{{ $wishlist->wishlist_items_count }} books</small><br>
                                <small>
                                    Created:
                                    {{ $wishlist->creation_date ? $wishlist->creation_date->format('M d, Y') : 'N/A' }}
                                </small>

                            </p>
                            @if($wishlist->is_public)
                            <span class="badge bg-success mb-2">Public</span>
                            @else
                            <span class="badge bg-secondary mb-2">Private</span>
                            @endif
                        </div>
                        <div class="card-footer">
                            <div class="btn-group w-100" role="group">
                                <a href="{{ route('account.wishlists.show', $wishlist->wish_list_id) }}"
                                    class="btn btn-outline-primary btn-sm">View</a>
                                <button class="btn btn-outline-secondary btn-sm edit-wishlist-btn"
                                    data-id="{{ $wishlist->wish_list_id }}" data-name="{{ $wishlist->name }}"
                                    data-public="{{ $wishlist->is_public }}">Edit</button>
                                <button class="btn btn-outline-danger btn-sm delete-wishlist-btn"
                                    data-id="{{ $wishlist->wish_list_id }}">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-heart fa-3x text-muted mb-3"></i>
                <h4>No Wishlists Yet</h4>
                <p class="text-muted">Create your first wishlist to save your favorite books!</p>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createWishlistModal">
                    Create Your First Wishlist
                </button>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Create Wishlist Modal -->
<div class="modal fade" id="createWishlistModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Wishlist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="createWishlistForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="wishlistName" class="form-label">Wishlist Name</label>
                        <input type="text" class="form-control" id="wishlistName" name="name" required>
                    </div>
                    <div class="form-check">
                        <input type="hidden" name="is_public" value="0">
                        <input class="form-check-input" type="checkbox" name="is_public" value="1" id="isPublic">
                        <label class="form-check-label" for="isPublic">
                            Make this wishlist public
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Wishlist</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Wishlist Modal -->
<div class="modal fade" id="editWishlistModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Wishlist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editWishlistForm">
                <div class="modal-body">
                    <input type="hidden" id="editWishlistId" name="wishlist_id">
                    <div class="mb-3">
                        <label for="editWishlistName" class="form-label">Wishlist Name</label>
                        <input type="text" class="form-control" id="editWishlistName" name="name" required>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="editIsPublic" name="is_public">
                        <label class="form-check-label" for="editIsPublic">
                            Make this wishlist public
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Wishlist</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    // Create Wishlist
document.getElementById('createWishlistForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    // Checkbox value ko properly handle karein
    const isPublicCheckbox = this.querySelector('input[name="is_public"]');
    if (isPublicCheckbox && isPublicCheckbox.checked) {
        formData.set('is_public', '1');
    } else {
        formData.set('is_public', '0');
    }
    
    fetch('{{ route("account.wishlists.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message || 'Error creating wishlist');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while creating the wishlist');
    });
});

// Edit Wishlist
document.querySelectorAll('.edit-wishlist-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const id = this.dataset.id;
        const name = this.dataset.name;
        const isPublic = this.dataset.public === '1';
        
        document.getElementById('editWishlistId').value = id;
        document.getElementById('editWishlistName').value = name;
        document.getElementById('editIsPublic').checked = isPublic;
        
        new bootstrap.Modal(document.getElementById('editWishlistModal')).show();
    });
});

// Edit Wishlist Form Handler
document.getElementById('editWishlistForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const wishlistId = document.getElementById('editWishlistId').value;
    
    // Handle checkbox value properly - explicitly set is_public value
    const isPublicCheckbox = document.getElementById('editIsPublic');
    formData.set('is_public', isPublicCheckbox.checked ? '1' : '0');
    
    // PUT method ke liye _method field add karein
    formData.append('_method', 'PUT');
    
    fetch(`/account/wishlists/${wishlistId}`, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (response.status === 422) {
            return response.json().then(data => {
                console.log('Validation errors:', data.errors);
                throw new Error(data.message || 'Validation failed');
            });
        }
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message || 'Error updating wishlist');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong: ' + error.message);
    });
});

// Delete Wishlist
document.querySelectorAll('.delete-wishlist-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        if (confirm('Are you sure you want to delete this wishlist?')) {
            const wishlistId = this.dataset.id;
            
            fetch(`/account/wishlists/${wishlistId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Error deleting wishlist');
                }
            });
        }
    });
});
</script>
@endsection