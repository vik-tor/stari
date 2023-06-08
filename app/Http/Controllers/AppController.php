<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

use App\Models\Notebook;
use App\Models\NotebookCategory;

class AppController extends Controller
{
  public function index(): Response
  {
    return Inertia::render('Index', [
      'notebooks' => Notebook::all(),
      'categories' => NotebookCategory::all()
    ]);
  }
}
