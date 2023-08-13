<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function categories()
    {
        // one to many relationship with category
        return $this->hasMany(category::class, 'category_id');
    }
}
