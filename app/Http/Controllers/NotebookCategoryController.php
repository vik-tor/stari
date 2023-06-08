<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotebookCategory;

class NotebookCategoryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        NotebookCategory::create($request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'string',
            'settings' => 'json',
        ]));

        return to_route('app');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NotebookCategory $notebookCategory)
    {
        $notebookCategory->update($request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'string',
            'settings' => 'json',
        ]));

        return to_route('app');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NotebookCategory $notebookCategory)
    {
        $notebookCategory->delete();

        return to_route('app');
    }
}
