<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): string
    {
        return 'HomeController -> index';
    }

    public function show(string $contact='E-mail') {
        return "Show {$contact}";
    }
}
