@extends('layout/template')

<main class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h1 class="card-title mb-0 text-center">Add a team to a league</h1>
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

            <form action="{{ url('teamLeagues') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="league_id" class="form-label">Id League</label>
                    <div>
                        <select name="league_id" id="league_id" class="form-select" required>

                            <option value="">Select the League</option>
                            @foreach ($leagues as $league)
                                <option value="{{ $league->id }}">{{ $league->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="team_id" class="form-label">Id Team</label>
                    <div>
                        <select name="team_id" id="team_id" class="form-select" required>

                            <option value="">Select the team</option>
                            @foreach ($teams as $team)
                                <option value="{{ $team->id }}"> {{ $team->name }}</option>
                            @endforeach
                        </select>
                    </div>
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
