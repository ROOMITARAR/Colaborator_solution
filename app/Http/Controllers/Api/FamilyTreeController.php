<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;

class FamilyTreeController extends Controller
{
    public function show($id)
    {
        $person = Person::findOrFail($id);

        // Get the family tree with a depth limit
        $familyTree = $person->familyTree();

        return response()->json($familyTree);
}
}
