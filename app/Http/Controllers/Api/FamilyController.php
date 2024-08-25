<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Family;

class FamilyController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => 'required|exists:people,id',
            'child_id' => 'required|exists:people,id|different:parent_id',
            'relationship_type' => 'required|string|max:255',
        ]);

        // Check if this relationship already exists
        $existingRelationship = Family::where('parent_id', $validated['parent_id'])
            ->where('child_id', $validated['child_id'])
            ->first();

        if ($existingRelationship) {
            return response()->json(['message' => 'This relationship already exists'], 409);
        }

        // Create the family relationship
        $family = Family::create($validated);

        return response()->json($family,201);
}

public function index()
{
    $family = Family::all();
    return response()->json($family);
}

  
      
    
}
