@extends('layout/template')

<main>
    <div>
        <h1>Crear Equipos</h1>

        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ url('teams') }}" method="post">
            @csrf
            <label for="nombre">Name</label>
            <div>
                <input type="text" name="name" id="name" value="{{ old('name') }}" >
            </div>

            <label for="country">country</label>
            <div>
                <input type="text" name="country" id="country" value="{{ old('country') }}" >
            </div>

            <label for="img">Image URL</label>
            <div>
                <input type="text" name="img" id="img" value="{{ old('img') }}" >
            </div>

            {{-- <label for="nombre">Nombre</label>
            <div>
                <select name="liga" id="liga"> --}}
            {{-- <option value="">Seleccionar la Liga</option> --}}
            {{-- Ver el video en minuto 37:45 par ver esto --}}
            {{-- </select> --}}
            {{-- </div> --}}
        </div>

        <a href="/" class="btn btn-danger">Regresar</a>
        <button type="submit" class="btn btn-success">Guardar</button>

    </div>
</main>
