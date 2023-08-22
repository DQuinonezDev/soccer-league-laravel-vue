@extends('layout/template')

<main class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h1 class="card-title mb-0 text-center">Create League</h1>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ url('leagues') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name of the League</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="form-control" placeholder="Insert the name of the League">
                </div>
               
                <div class="mb-3">
                    <label for="img" class="form-label">Image URL</label>
                    <input type="text" name="img" id="img" value="{{ old('img') }}"
                        class="form-control" placeholder="Insert image URL" ">
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


