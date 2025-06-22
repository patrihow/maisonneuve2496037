@extends('layouts.app')

@section('title', __('forum.documents'))

@section('content')
<div class="container mt-4">
    <h1>{{ __('forum.documents') }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('documents.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> {{ __('forum.add_document') }}
    </a>

    @if($documents->count())
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{ __('forum.title') }}</th>
                <th>{{ __('forum.user') }}</th>
                <th>{{ __('forum.date') }}</th>
                <th>{{ __('forum.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
            <tr>
                <td>{{ app()->getLocale() == 'fr' ? $document->title_fr : $document->title_en }}</td>
                <td>{{ $document->user->name ?? '-' }}</td>
                <td>{{ $document->created_at->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="btn btn-info btn-sm">
                        <i class="bi bi-download"></i> {{ __('forum.download') }}
                    </a>
                    @can('update', $document)
                    <a href="{{ route('documents.edit', $document) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i> {{ __('forum.edit') }}
                    </a>
                    @endcan
                    @can('delete', $document)
                    <form action="{{ route('documents.destroy', $document) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('forum.confirm_delete') }}');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i> {{ __('forum.delete') }}
                        </button>
                    </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $documents->links() }}

    @else
    <p>{{ __('forum.no_documents') }}</p>
    @endif
</div>
@endsection
