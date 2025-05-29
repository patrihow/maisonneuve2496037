@extends('layouts.app')

@section('title', 'Liste des étudiants')

@section('content')
<div class="d-flex justify-content-between align-items-center mt-4 mb-3">
    <h1 class="h3 mb-0"><i class="bi bi-people"></i> Liste des étudiants</h1>
    <a href="{{ route('student.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus"></i> Ajouter un étudiant
    </a>
</div>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
    <table class="table table-hover align-middle shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Date de naissance</th>
                <th>Ville</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td class="fw-semibold">{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ \Carbon\Carbon::parse($student->birthdate)->format('d/m/Y') }}</td>
                    <td>{{ optional($student->city)->name ?? '-' }}</td>
                    <td class="text-end">
                        <a href="{{ route('student.show', $student->id) }}" class="btn btn-sm btn-outline-info me-1" title="Voir">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('student.edit', $student->id) }}" class="btn btn-sm btn-outline-warning me-1" title="Éditer">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('student.destroy', $student->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Voulez-vous vraiment supprimer cet étudiant ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Aucun étudiant trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
     {{ $students->links('pagination::bootstrap-5') }} 
</div>
@endsection
