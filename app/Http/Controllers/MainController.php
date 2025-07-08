<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(): View
    {
        return view('home');
    }

    public function generateExercises(Request $request): View
    {
        $request->validate([
            'check_sum' => 'required_without_all:check_subtraction,check_multiplication,check_division',
            'check_subtraction' => 'required_without_all:check_sum,check_multiplication,check_division',
            'check_multiplication' => 'required_without_all:check_sum,check_subtraction,check_division',
            'check_division' => 'required_without_all:check_sum,check_subtraction,check_multiplication',
            'number_one' => 'required|integer|min:0|max:999|lt:number_two',
            'number_two' => 'required|integer|min:1|max:999',
            'number_exercises' => 'required|integer|min:5|max:100',
        ], [
            'check_sum.required_without_all' => 'Pelo menos uma operação deve ser selecionada.',
            'check_subtraction.required_without_all' => 'Pelo menos uma operação deve ser selecionada.',
            'check_multiplication.required_without_all' => 'Pelo menos uma operação deve ser selecionada.',
            'check_division.required_without_all' => 'Pelo menos uma operação deve ser selecionada.',
            'number_one.required' => 'O campo mínimo é obrigatório.',
            'number_one.integer' => 'O campo mínimo deve ser um número inteiro.',
            'number_one.min' => 'O campo mínimo deve ser pelo menos 0.',
            'number_one.max' => 'O campo mínimo não pode ser maior que 999.',
            'number_one.lt' => 'O campo mínimo deve ser menor que o campo máximo.',
            'number_two.required' => 'O campo máximo é obrigatório.',
            'number_two.integer' => 'O campo máximo deve ser um número inteiro.',
            'number_two.min' => 'O campo máximo deve ser pelo menos 1.',
            'number_two.max' => 'O campo máximo não pode ser maior que 999.',
            'number_exercises.required' => 'O número de exercícios é obrigatório.',
            'number_exercises.integer' => 'O número de exercícios deve ser um número inteiro.',
            'number_exercises.min' => 'O número de exercícios deve ser pelo menos 5.',
            'number_exercises.max' => 'O número de exercícios não pode ser maior que 100.',
        ]);

        $operations = [];
        if ($request->check_sum) {
            $operations[] = 'sum';
        }
        if ($request->check_subtraction) {
            $operations[] = 'subtraction';
        }
        if ($request->check_multiplication) {
            $operations[] = 'multiplication';
        }
        if ($request->check_division) {
            $operations[] = 'division';
        }

        $min = $request->number_one;
        $max = $request->number_two;

        $numberExercises = $request->number_exercises;

        $exercises = [];
        for ($index = 0; $index < $numberExercises; $index++) {
            $exercises[] = $this->generateExercise($index, $operations, $min, $max);
        }

        session(['exercises' => $exercises]);
        return view('operations', ['exercises' => $exercises]);
    }

    public function printExercises()
    {
        if (!session()->has('exercises')) {
            return redirect()->route('home');
        }
        $exercises = session('exercises');

        echo '<pre>';
        echo '<h1>Exercícios de matemática (' . env('APP_NAME') . ')</h1>';
        foreach ($exercises as $exercise) {
            echo '<h2><small>' . $exercise['exercise_number'] . '</small>. ' . $exercise['exercise'] . '</h2>';
        }
        echo '<hr>';
        echo '<small>Respostas</small><br>';
        foreach ($exercises as $exercise) {
            echo '<small>' . $exercise['exercise_number'] . '. ' . $exercise['solution'] . '</small><br>';
        }
        echo '<hr>';
        echo '</pre>';
    }

    public function exportExercises(): void
    {
        echo 'Printing exercises...';
    }

    private function generateExercise($index, $operations, $min, $max)
    {
        $operation = $operations[array_rand($operations)];
        $number1 = rand($min, $max);
        $number2 = rand($min, $max);

        $exercise = '';
        $solution = '';

        switch ($operation) {
            case 'sum':
                $exercise = "$number1 + $number2 = ";
                $solution = $number1 + $number2;
                break;
            case 'subtraction':
                $exercise = "$number1 - $number2 = ";
                $solution = $number1 - $number2;
                break;
            case 'multiplication':
                $exercise = "$number1 x $number2 = ";
                $solution = $number1 * $number2;
                break;
            case 'division':
                if ($number2 == 0) {
                    $number2 = 1;
                }
                $exercise = "$number1 : $number2 = ";
                $solution = $number1 / $number2;
                break;
        }

        if (is_float($solution)) {
            $solution = number_format($solution, 2, ',', '.');
        }

        return [
            'operations' => $operation,
            'exercise_number' => str_pad($index, 2, '0', STR_PAD_LEFT),
            'exercise' => $exercise,
            'solution' => "$exercise $solution",
        ];
    }
}
