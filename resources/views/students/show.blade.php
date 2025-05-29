@extends('layouts.app')

@section('title', 'Détails de l\'étudiant')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4"><i class="bi bi-person"></i> Détails de l'étudiant</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">{{ $student->name }}</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Email :</strong> {{ $student->email }}</li>
                <li class="list-group-item"><strong>Date de naissance :</strong> {{ \Carbon\Carbon::parse($student->birthdate)->format('d/m/Y') }}</li>
                <li class="list-group-item"><strong>Ville :</strong> {{ optional($student->city)->name ?? '-' }}</li>
            </ul>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning me-2">
                <i class="bi bi-pencil"></i> Éditer
            </a>
            <a href="{{ route('student.index') }}" class="btn btn-secondary">
                Retour à la liste
            </a>
        </div>
    </div>
</div>
@endsection
