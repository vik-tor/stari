<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notebook;

class NotebookController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Notebook::create($request->validate([
            'name' => 'required|string|max:255',
            'notebook_category_id' => 'required'
        ]));

        return to_route('app');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notebook $notebook)
    {
        $notebook->update($request->validate([
            'name' => 'required|string|max:255',
            'notebook_category_id' => 'required',
            'settings' => 'json',
        ]));

        return to_route('app');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notebook $notebook)
    {
        $notebook->delete();

        return to_route('app');
    }
}
