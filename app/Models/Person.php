<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    
    protected $table = 'people';
    protected $fillable= [
        'first_name',
        'last_name',
        'date_of_birth',
        'email',
        'phone',

    ];
// A person can have many children
    public function children()
    {
        return $this->hasMany(Family::class, 'parent_id');
    }

    // A person can have many parents
    public function parents()
    {
        return $this->hasMany(Family::class, 'child_id');
    }

    // Get all people who are children of this person
    public function childrenPeople()
    {
        return $this->hasManyThrough(Person::class, Family::class, 'parent_id', 'id', 'id', 'child_id');
    }

    // Get all people who are parents of this person
    public function parentPeople()
    {
        return $this->hasManyThrough(Person::class, Family::class, 'child_id', 'id', 'id', 'parent_id');
    }


    public function familyTree($depth = 3)
    {
        if ($depth === 0) {
            return null;
        }

        $tree = [
            'person' => $this,
            'parents' => $this->parentPeople()->with('parentPeople', 'childrenPeople')->get()->map(function ($parent) use ($depth) {
                return $parent->familyTree($depth - 1);
            }),
            'children' => $this->childrenPeople()->with('parentPeople', 'childrenPeople')->get()->map(function ($child) use ($depth) {
                return $child->familyTree($depth - 1);
            }),
        ];

        return $tree;
}
}
