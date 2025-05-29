@extends('layouts.app')

@section('title', 'Ajouter un étudiant')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4"><i class="bi bi-person-plus"></i> Ajouter un étudiant</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('student.store') }}" method="POST" class="card shadow-sm p-4">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" id="name" class="form-control"
                   value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email" name="email" id="email" class="form-control"
                   value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="birthdate" class="form-label">Date de naissance</label>
            <input type="date" name="birthdate" id="birthdate" class="form-control"
                   value="{{ old('birthdate') }}" required>
        </div>

        <div class="mb-3">
            <label for="city_id" class="form-label">Ville</label>
            <select name="city_id" id="city_id" class="form-select" required>
                <option value="">-- Sélectionnez une ville --</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}"
                        {{ old('city_id') == $city->id ? 'selected' : '' }}>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control"
                   required minlength="6" maxlength="20">
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('student.index') }}" class="btn btn-secondary me-2">Annuler</a>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>
</div>
@endsection
