@extends('layouts.app')
@section('styles')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('main')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-9">
            {{-- @include('layouts.message') --}}

            <div class="min-h-screen bg-gradient-to-br from-purple-50 via-pink-50 to-indigo-100 py-6">
                <div class="max-w-4xl mx-auto px-4">

                    {{-- Header Section --}}
                    <div class="text-center mb-8">
                        <h1
                            class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-2">
                            {{-- <i class="fas fa-heart text-red-500 mr-3" style="color: red"></i> --}}
                            ❤️Genre Preferences
                        </h1>
                        <p class="text-gray-600 text-lg">Customize your reading experience</p>
                    </div>

                    {{-- Success/Error Messages --}}
                    @include('layouts.message')

                    {{-- Add New Preference --}}
                    @if($availableGenres->count() > 0)
                    <div
                        style="background: linear-gradient(to right, #4facfe, #a18cd1); border-radius: 20px; padding: 5px; margin-bottom: 30px;">
                        <div style="background: white; border-radius: 20px; padding: 25px;">
                            <h2
                                style="font-size: 22px; font-weight: bold; color: #2d3748; margin-bottom: 25px; display: flex; align-items: center; margin-left: 10px;">
                                <div
                                    style="background: linear-gradient(to right, #34d399, #10b981); padding: 10px; border-radius: 50%; margin-right: 15px;">
                                    <i class="fas fa-plus" style="color: white; font-size: 18px;"></i>
                                </div>
                                Add New Genre Preference
                            </h2>

                            <form action="{{ route('preferences.store') }}" method="POST">
                                @csrf
                                <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                                    <!-- Genre Dropdown -->
                                    <div style="flex: 1; min-width: 250px;">
                                        <label
                                            style="display: block; font-weight: bold; font-size: 14px; color: #4a5568; margin-bottom: 10px;">
                                            <i class="fas fa-list" style="color: #8b5cf6; margin-right: 6px;"></i>
                                            Select Genre
                                        </label>
                                        <select name="genre_id" 
                                            style="width: 100%; border: 2px solid #e9d5ff; border-radius: 10px; padding: 8px 12px; font-size: 14px; color: #374151; background: linear-gradient(to right, #f3e8ff, #fce7f3);">
                                            <option value="">🎭 Choose a genre...</option>
                                            @foreach($availableGenres as $genre)
                                            <option value="{{ $genre->genre_id }}" style="color: #374151;">
                                                {{ $genre->icon }} {{ $genre->genre_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('genre_id')
                                        <p style="color: red; font-size: 13px; margin-top: 8px;">
                                            <i class="fas fa-exclamation-triangle" style="margin-right: 4px;"></i> {{
                                            $message }}
                                        </p>
                                        @enderror
                                    </div>

                                    <!-- Preference Weight -->
                                    <div style="flex: 1; min-width: 250px;">
                                        <label
                                            style="display: block; font-weight: bold; font-size: 14px; color: #4a5568; margin-bottom: 10px;">
                                            <i class="fas fa-star" style="color: #fbbf24; margin-right: 6px;"></i>
                                            Preference Weight (1-10)
                                        </label>
                                        <input type="range" name="preference_weight" min="1" max="10" value="5"
                                            style="width: 100%; height: 6px; background: linear-gradient(to right, #fde68a, #fdba74); border-radius: 10px; appearance: none; cursor: pointer;"
                                            oninput="updateWeightDisplay(this.value)">
                                        <div
                                            style="display: flex; justify-content: space-between; font-size: 13px; color: #4b5563; margin-top: 10px;">
                                            <span
                                                style="background: #fef3c7; padding: 3px 8px; border-radius: 999px;">😐
                                                1</span>
                                            <span id="weight-display"
                                                style="font-weight: bold; font-size: 18px; background: linear-gradient(to right, #7c3aed, #ec4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                                🔥 5
                                            </span>
                                            <span
                                                style="background: #fecaca; padding: 3px 8px; border-radius: 999px;">🔥
                                                10</span>
                                        </div>
                                        @error('prefrence_weight')
                                        <p style="color: red; font-size: 13px; margin-top: 8px;">
                                            <i class="fas fa-exclamation-triangle" style="margin-right: 4px;"></i> {{
                                            $message }}
                                        </p>
                                        @enderror
                                    </div>

                                    <!-- Submit Button -->
                                    <div style="flex: 1; min-width: 250px; display: flex; align-items: flex-end;">
                                        <button type="submit"
                                            style="width: 100%; background: linear-gradient(to right, #22c55e, #059669); color: white; padding: 10px 16px; border-radius: 10px; font-size: 14px; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); cursor: pointer;">
                                            <i class="fas fa-plus-circle" style="font-size: 14px;"></i>
                                            <span>Add Preference</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif

                    {{-- Active Preferences --}}
                    <div
                        style="background: linear-gradient(to right, #4facfe, #a18cd1); border-radius: 20px; padding: 5px; margin-bottom: 30px;">
                        <div style="background: white; border-radius: 20px; padding: 25px;">
                            <h2 style="font-size: 20px; font-weight: bold; margin-bottom: 20px; color: #333;">
                                ❤️ Active Preferences ({{ $activePreferences->count() }})
                            </h2>

                            @if($activePreferences->isEmpty())
                            <div style="text-align: center; color: gray; margin-top: 40px;">
                                <div style="font-size: 60px;">📚</div>
                                <p style="font-size: 18px; font-weight: bold;">No active preferences yet!</p>
                                <p>Add some genres above to get started.</p>
                            </div>
                            @else
                            @foreach($activePreferences as $preference)
                            <div
                                style="border: 1px solid #ccc; border-radius: 10px; padding: 15px; margin-bottom: 15px; background: #f9f9f9;">
                                <div style="display: flex; align-items: center; justify-content: space-between;">
                                    <!-- Left: Icon & Info -->
                                    <div style="display: flex; align-items: center;">
                                        <div style="font-size: 24px; margin-right: 12px;">
                                            {{ $preference->genre->icon }}
                                        </div>
                                        <div>
                                            <div style="font-weight: bold; font-size: 16px; color: #444;">
                                                {{ $preference->genre->genre_name }}
                                            </div>
                                            <div style="font-size: 12px; color: gray;">
                                                📅 Added: {{ $preference->created_date->format('M d, Y') }}
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right: Buttons -->
                                    <div style="display: flex; gap: 8px;">
                                        <form
                                            action="{{ route('preferences.toggle', ['prefrence_id' => $preference->prefrence_id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button title="Deactivate" type="submit"
                                                style="border: none; background: #ffc107; color: white; padding: 6px 10px; border-radius: 5px; cursor: pointer;">
                                                ⏸
                                            </button>
                                        </form>

                                        <form action="{{ route('preferences.destroy', $preference->prefrence_id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this preference?')">
                                            @csrf
                                            @method('DELETE')
                                            <button title="Delete" type="submit"
                                                style="border: none; background: #dc3545; color: white; padding: 6px 10px; border-radius: 5px; cursor: pointer;">
                                                
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Weight stars -->
                                <div style="margin-top: 10px; font-size: 14px;">
                                    <strong>🏋️ Weight:</strong>
                                    @for($i = 1; $i <= 10; $i++) <button
                                        onclick="updateWeight({{ $preference->prefrence_id }}, {{ $i }})"
                                        style="border: none; background: none; font-size: 16px; cursor: pointer; color: {{ $i <= $preference->preference_weight ? '#ffc107' : '#ccc' }};">
                                        ★
                                        </button>
                                        @endfor
                                        <span style="margin-left: 5px; font-weight: bold;">{{$preference->preference_weight }}/10</span>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>

                    {{-- Inactive Preferences --}}
                    @if($inactivePreferences->count() > 0)
                    <div style="background: #f0f0f0; padding: 20px; border-radius: 15px; margin-bottom: 30px;">
                        <h2 style="font-size: 24px; font-weight: bold; color: #333; margin-bottom: 20px;">
                            <i class="fas fa-pause-circle" style="color: gray; margin-right: 10px;"></i>
                            Inactive Preferences
                            <span
                                style="background: gray; color: white; padding: 5px 15px; border-radius: 20px; font-size: 14px; margin-left: 10px;">
                                {{ $inactivePreferences->count() }}
                            </span>
                        </h2>

                        @foreach($inactivePreferences as $preference)
                        <div
                            style="display: flex; align-items: center; justify-content: space-between; background: white; border: 1px solid #ccc; border-radius: 10px; padding: 15px 20px; margin-bottom: 15px;">
                            <!-- Left Side -->
                            <div style="display: flex; align-items: center;">
                                <div
                                    style="font-size: 28px; background: #f8f8f8; padding: 10px; border-radius: 50%; margin-right: 15px;">
                                    {{ $preference->genre->icon }}
                                </div>
                                <div>
                                    <div style="font-weight: bold; font-size: 18px; color: #444;">{{
                                        $preference->genre->genre_name }}</div>
                                    <div style="color: #666; font-size: 14px;">
                                        <strong>🏋️ Weight:</strong>
                                        @for($i = 1; $i <= 10; $i++) <i class="fas fa-star"
                                            style="margin-right: 2px; color: {{ $i <= $preference->preference_weight ? '#ffc107' : '#ccc' }};">
                                            </i>
                                        @endfor
                                        <span style="margin-left: 5px;">{{ $preference->preference_weight}}/10</span>
                                    </div>

                                </div>
                            </div>

                            <!-- Right Buttons -->
                            <div style="display: flex; gap: 10px;">
                                <form action="{{ route('preferences.toggle', $preference->prefrence_id) }}"
                                    method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" title="Activate"
                                        style="background: #28a745; color: white; border: none; padding: 8px 14px; border-radius: 8px; font-size: 14px; cursor: pointer;">
                                        <i class="fas fa-play"></i> Activate
                                    </button>
                                </form>

                                <form action="{{ route('preferences.destroy', $preference->prefrence_id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this preference?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Delete"
                                        style="background: #dc3545; color: white; border: none; padding: 8px 12px; border-radius: 8px; font-size: 14px; cursor: pointer;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // Weight display update function
function updateWeightDisplay(value) {
    document.getElementById('weight-display').textContent = value;
}

// AJAX function for updating weight
function updateWeight(preferenceId, weight) {
    fetch(`/prefrences/${preferenceId}/weight`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ prefrence_weight: weight })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the stars display
            const stars = document.querySelectorAll(`[onclick*="${preferenceId}"]`);
            stars.forEach((star, index) => {
                if (index < weight) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            });
            
            // Update weight display
            const weightDisplay = star.parentElement.querySelector('.font-medium');
            if (weightDisplay) {
                weightDisplay.textContent = `${weight}/10`;
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to update weight. Please try again.');
    });
}
</script>
@endsection