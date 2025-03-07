@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Demander un congé</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('conges.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="date_debut">Date début :</label>
                            <input type="date" name="date_debut" id="date_debut" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="date_fin">Date fin :</label>
                            <input type="date" name="date_fin" id="date_fin" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="motif">Motif :</label>
                            <textarea name="motif" id="motif" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Soumettre</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
