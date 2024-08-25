<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index()
    {
        $people = Person::all();
        return response()->json($people);
    }

    // Get a specific person
    public function show($id)
    {
        $person = Person::findOrFail($id);
        return response()->json($person);
    }

    // Create a new person
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        $person = new Person();
        $person->first_name = $request->first_name;
        $person->last_name = $request->last_name;
        $person->email = $request->email;
        $person->phone = $request->phone;
        $person->date_of_birth = $request->date_of_birth;
        $person->save();
        return response()->json([
            "message" => 'Person Created Successfully',
            "person" => $person
        ], 200);
    }

    // Update an existing person
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        $person = Person::find($id);
        $person->first_name = $request->first_name;
        $person->last_name = $request->last_name;
        $person->email = $request->email;
        $person->phone = $request->phone;
        $person->date_of_birth = $request->date_of_birth;
        $person->save();
        return response()->json([
            "message" => 'Person Updated Successfully',
            "person" => $person
        ], 200);
    }

    // Delete a person
    public function destroy($id)
    {
        $person = Person::findOrFail($id);
        $person->delete();
        
        return response()->json(null, 204);
    }
}
