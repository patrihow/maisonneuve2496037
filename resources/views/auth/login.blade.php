@extends('layouts.app')
@section('title', 'Connexion')
@section('content')
<div class="container mt-4 d-flex align-items-center">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('images/login.jpg') }}" class="img-fluid" alt="Imagen descriptiva">
        </div>
        <div class="col-md-6">
            <h1>Connexion</h1>
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Se Connecter</button>
                <p><a href="#">Mot de passe oublié ?</a></p>
            </form>
        </div>
    </div>
</div>
@endsection
