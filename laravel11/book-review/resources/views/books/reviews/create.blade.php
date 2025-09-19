@extends('layouts.app')

@section('content')
    <h1 class="mb-10 text-2xl">Add Review for {{ $book->title }}</h1>

    <form method="POST" action="{{ route('books.reviews.store', $book) }}">
        @csrf
        <div>
            <label for="review">Review</label>
            <textarea name="review" id="review" required
                class="input"
                @class(['invalid' => $errors->has('review')])>{{old('review')}}</textarea>
            @error('review')
                <span class="error mb-6">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="rating">Rating</label>
            <select name="rating" id="rating" class="input" required>
                <option>Select a Rating</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
            @error('rating')
                <span class="error mb-6">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn mt-3">Add Review</button>
    </form>
@endsection
