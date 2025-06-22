@extends('layouts.app')

@section('title', __('forum.edit_document'))

@section('content')
<div class="container mt-4">
    <h1>{{ __('forum.edit_document') }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('documents.update', $document) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title_en" class="form-label">{{ __('forum.title_en') }}</label>
            <input type="text" name="title_en" id="title_en" class="form-control" value="{{ old('title_en', $document->title_en) }}">
        </div>

        <div class="mb-3">
            <label for="title_fr" class="form-label">{{ __('forum.title_fr') }}</label>
            <input type="text" name="title_fr" id="title_fr" class="form-control" value="{{ old('title_fr', $document->title_fr) }}">
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">{{ __('forum.file') }}</label>
            <input type="file" name="file" id="file" class="form-control" accept=".pdf,.zip,.doc,.docx">
            <div class="form-text">{{ __('forum.leave_empty_to_keep') }}</div>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('forum.update') }}</button>
        <a href="{{ route('documents.index') }}" class="btn btn-secondary">{{ __('forum.cancel') }}</a>
    </form>
</div>
@endsection
