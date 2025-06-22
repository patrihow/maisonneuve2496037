@extends('layouts.app')

@section('title', __('forum.edit_article'))

@section('content')
<div class="container mt-4">
    <h1>{{ __('forum.edit_article') }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('articles.update', $article) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title_en" class="form-label">{{ __('forum.title_en') }}</label>
            <input type="text" name="title_en" id="title_en" class="form-control" value="{{ old('title_en', $article->title_en) }}">
        </div>

        <div class="mb-3">
            <label for="title_fr" class="form-label">{{ __('forum.title_fr') }}</label>
            <input type="text" name="title_fr" id="title_fr" class="form-control" value="{{ old('title_fr', $article->title_fr) }}">
        </div>

        <div class="mb-3">
            <label for="content_en" class="form-label">{{ __('forum.content_en') }}</label>
            <textarea name="content_en" id="content_en" class="form-control" rows="5">{{ old('content_en', $article->content_en) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="content_fr" class="form-label">{{ __('forum.content_fr') }}</label>
            <textarea name="content_fr" id="content_fr" class="form-control" rows="5">{{ old('content_fr', $article->content_fr) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('forum.update') }}</button>
        <a href="{{ route('articles.index') }}" class="btn btn-secondary">{{ __('forum.cancel') }}</a>
    </form>
</div>
@endsection
