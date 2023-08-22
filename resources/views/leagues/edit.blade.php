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

        <form action="{{ url('leagues/'.$league->id) }}" method="post">
            @method('PUT')
            @csrf
            <label for="name">Name</label>
            <div>
                <input type="text" name="name" id="name" value="{{ $league->name }}" >
            </div>

            
            <label for="img">Url imagen</label>
            <div>
                <input type="text" name="img" id="img" value="{{ $league->img }}" >
            </div>

            
        </div>

        <a href="/" class="btn btn-danger">Regresar</a>
        <button type="submit" class="btn btn-success" href='/'>Guardar</button>

    </div>
</main>
