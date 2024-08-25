<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;
    
    protected $table = 'families';
    protected $fillable= [
            'parent_id',
            'child_id',
            'relationship_type',
    ];
    public function parent()
    {
        return $this->belongsTo(Person::class, 'parent_id');
    }

    // A family record belongs to a child
    public function child()
    {
        return $this->belongsTo(Person::class, 'child_id');
    }
}
