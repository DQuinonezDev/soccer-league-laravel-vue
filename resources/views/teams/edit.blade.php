@extends('layout/template')

<main>
    <div>
        <h1>Editar Equipos</h1>

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

        <form action="{{ url('teams/'.$team->id) }}" method="post">
            @method('PUT')
            @csrf
            <label for="name">Name</label>
            <div>
                <input type="text" name="name" id="name" value="{{ $team->name }}" >
            </div>

            <label for="country">Country</label>
            <div>
                <input type="text" name="country" id="country" value="{{ $team->country }}" >
            </div>

            <label for="img">Url imagen</label>
            <div>
                <input type="text" name="img" id="img" value="{{ $team->img }}" >
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
        <button type="submit" class="btn btn-success" href='/'>Guardar</button>

    </div>
</main>
