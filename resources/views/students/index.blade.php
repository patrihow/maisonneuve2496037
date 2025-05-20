@extends('layouts.app')

@section('title', 'Liste des étudiants')

@section('content')
    <h1 class="mt-5">Liste des étudiants</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>
                        <a href="{{ route('student.show', $student->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('student.destroy', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $students->links() }} 
@endsection