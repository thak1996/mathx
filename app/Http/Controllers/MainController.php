<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(): void
    {
        echo 'Welcome to the Laravel application!';
    }

    public function generateExercises(Request $request): void
    {
        echo 'Generating exercises...';
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
