<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Notebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EntryController extends Controller
{
	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$notebook = Notebook::find($request->notebook_id);
		$entry = Entry::factory()->for($notebook)->create();

		return redirect()->back();
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Entry $entry)
	{
		$entry->update($request->validate([
			'title' => 'required|string|max:255',
			'body' => 'required',
		]));

		return to_route('app');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Entry $entry)
	{
		$entry->delete();

		return to_route('app');
	}
}
