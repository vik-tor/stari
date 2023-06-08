<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Entry::create($request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'notebook_id' => 'required'
        ]));

        return to_route('app');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entry $entry)
    {
        $entry->update($request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'notebook_id' => 'json',
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
