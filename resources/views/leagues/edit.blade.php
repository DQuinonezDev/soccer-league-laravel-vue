@extends('layout/template')

<main class="container">
    <div class="card">
        <div class="card-header bg-primary text-white py-3">
            <h1 class="mb-0">Edit Leagues</h1>
        </div>
        <div class="card-body">
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
                <div class="mb-3">
                    <label for="name">Name of the league</label>
                    <input type="text" name="name" id="name" value="{{ $league->name }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="img">Image URL</label>
                    <input type="text" name="img" id="img" value="{{ $league->img }}" class="form-control">
                </div>

                <div class="d-flex justify-content-end">
                    <a href="/" class="btn btn-outline-danger me-2">Cancel</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</main>

<style>
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        border-radius: 15px 15px 0 0;
    }

    .alert {
        border-radius: 15px;
    }

    .btn-outline-danger {
        border-radius: 10px;
    }
</style>
