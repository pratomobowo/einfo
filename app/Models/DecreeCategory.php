<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DecreeCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the decrees that belong to this category.
     */
    public function decrees()
    {
        return $this->hasMany(Decree::class, 'category_id');
    }
} 