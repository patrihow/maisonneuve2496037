@extends('layouts.app')

@section('title', __('forum.forum'))

@section('content')
<div class="container mt-4">
    <h1>{{ __('forum.forum') }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('articles.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> {{ __('forum.create_article') }}
    </a>

    @if($articles->count())
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
            @foreach($articles as $article)
            <tr>
                <td>{{ app()->getLocale() == 'fr' ? $article->title_fr : $article->title_en }}</td>
                <td>{{ $article->user->name ?? '-' }}</td>
                <td>{{ $article->created_at->format('d/m/Y') }}</td>
                <td>
                    @can('update', $article)
                    <a href="{{ route('articles.edit', $article) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i> {{ __('forum.edit') }}
                    </a>
                    @endcan

                    @can('delete', $article)
                    <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('forum.confirm_delete_article') }}');">
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

    {{ $articles->links() }}

    @else
    <p>{{ __('forum.no_articles') }}</p>
    @endif
</div>
@endsection
