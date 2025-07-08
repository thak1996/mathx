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

    public function generateExercises(Request $request): void
    {
        $request->validate([
            'check_sum' => 'required_without_all:check_subtraction,check_multiplication,check_division',
            'check_subtraction' => 'required_without_all:check_sum,check_multiplication,check_division',
            'check_multiplication' => 'required_without_all:check_sum,check_subtraction,check_division',
            'check_division' => 'required_without_all:check_sum,check_subtraction,check_multiplication',
            'number_one' => 'required|integer|min:1|max:999',
            'number_two' => 'required|integer|min:1|max:999',
            'number_exercises' => 'required|integer|min:5|max:100',
        ], [
            'check_sum.required_without_all' => 'Pelo menos uma operação deve ser selecionada.',
            'check_subtraction.required_without_all' => 'Pelo menos uma operação deve ser selecionada.',
            'check_multiplication.required_without_all' => 'Pelo menos uma operação deve ser selecionada.',
            'check_division.required_without_all' => 'Pelo menos uma operação deve ser selecionada.',
            'number_one.required' => 'O campo mínimo é obrigatório.',
            'number_one.integer' => 'O campo mínimo deve ser um número inteiro.',
            'number_one.min' => 'O campo mínimo deve ser pelo menos 1.',
            'number_one.max' => 'O campo mínimo não pode ser maior que 999.',
            'number_two.required' => 'O campo máximo é obrigatório.',
            'number_two.integer' => 'O campo máximo deve ser um número inteiro.',
            'number_two.min' => 'O campo máximo deve ser pelo menos 1.',
            'number_two.max' => 'O campo máximo não pode ser maior que 999.',
            'number_exercises.required' => 'O número de exercícios é obrigatório.',
            'number_exercises.integer' => 'O número de exercícios deve ser um número inteiro.',
            'number_exercises.min' => 'O número de exercícios deve ser pelo menos 5.',
            'number_exercises.max' => 'O número de exercícios não pode ser maior que 100.',
        ]);

        dd($request->all());
    }

    public function printExercises(): void
    {
        echo 'Printing exercises...';
    }

    public function exportExercises(): void
    {
        echo 'Printing exercises...';
    }
}
