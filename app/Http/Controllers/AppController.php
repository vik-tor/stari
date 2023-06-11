<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

use App\Models\Notebook;
use App\Models\NotebookCategory;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
	public function index(): Response
	{
		return Inertia::render('Index', [
			'notebooks' => Notebook::all()->load('entries'),
			'categories' => NotebookCategory::all()
		]);
	}

	public function parse(Request $request)
	{
		$request->validate([
			'upload' => 'required|file',
			'notebook_id' => 'required'
		]);

		$raw_notes = file_get_contents($request->upload);
		$notes = json_decode($raw_notes, true);
		$entries = $notes['entries'];
		$name = $_FILES['upload']['name'];

		$notebook = Notebook::findOr($request->notebook_id, fn () => Notebook::create([
			'name' => $name,
			'notebook_category_id' => 1
		]));

		foreach ($entries as $entry) {
			$dateString = $entry['date'];
			$dateString .= ' ';
			$dateString .= $entry['time'];
			$strtime = strtotime($dateString);

			DB::table('entries')->insert([
				'title' => $entry['title'],
				'body' => $entry['body'],
				'notebook_id' => $notebook->id,
				'created_at' => date('Y-m-d H:i:s', $strtime)
			]);
		}

		return to_route('app');
	}
}
