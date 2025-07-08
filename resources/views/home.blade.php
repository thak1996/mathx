@extends('layouts.main_layout')

@section('content')

<h3 class="text-center text-secondary mb-5">
    Selecione as opções para gerar<br><span class="text-info">exercícios de matemática</span>.
</h3>

<!-- form -->
<form action="{{ route('generateExercises') }}" method="post" novalidate>
    @csrf

    <div class="container border border-primary rounded-3 p-5">

        <div class="row gap-5">

            <!-- 4 checkboxes -->
            <div class="col">

                <p class="text-info">Operações:</p>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="check_sum" name="check_sum" checked>
                    <label class="form-check-label" for="check_sum">Soma</label>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="check_subtraction" name="check_subtraction"
                        checked>
                    <label class="form-check-label" for="check_subtraction">Subtração</label>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="check_multiplication"
                        name="check_multiplication" checked>
                    <label class="form-check-label" for="check_multiplication">Multiplicação</label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="check_division" name="check_division"
                        checked>
                    <label class="form-check-label" for="check_division">Divisão</label>
                </div>

            </div>

            <!-- parcelas -->
            <div class="col">

                <p class="text-info">Parcelas:</p>

                <div class="mb-3">
                    <label for="number_one">Mínimo:</label>
                    <input type="number" class="form-control" id="number_one" name="number_one" min="0"
                        max="999" value="{{ old('number_one', 0) }}">
                </div>

                <div>
                    <label for="number_two">Máximo:</label>
                    <input type="number" class="form-control" id="number_two" name="number_two" min="0"
                        max="999" value="{{ old('number_two', 100) }}">
                </div>

            </div>

            <!-- number of exercises and submit -->
            <div class="col">

                <p class="text-info">Número de exercícios:</p>

                <div class="mb-3">
                    <label for="number_exercises">Número:</label>
                    <input type="number" class="form-control" id="number_exercises" name="number_exercises"
                        min="5" max="50" value="{{ old('number_exercises', 10) }}">
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Gerar exercícios</button>
                </div>

            </div>

        </div>

    </div>

</form>

@if ($errors->any() || session('errors'))
<div class="container mt-3">
    <div class="alert alert-danger">
        <ul>
            @foreach (($errors->all() ?: session('errors')->all()) as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

@endsection