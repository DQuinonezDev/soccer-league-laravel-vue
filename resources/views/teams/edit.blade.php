@extends('layout/template')

<main class="container">
    <div class="card">
        <div class="card-header bg-primary text-white py-3">
            <h1 class="mb-0">Edit Teams</h1>
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

            <form action="{{ url('teams/'.$team->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name of the team</label>
                    <input type="text" name="name" id="name" value="{{ $team->name }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" name="country" id="country" value="{{ $team->country }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="img" class="form-label">Image URL</label>
                    <input type="text" name="img" id="img" value="{{ $team->img }}" class="form-control">
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
