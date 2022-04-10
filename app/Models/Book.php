<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public function borrows(){
        return $this->hasMany(Borrow::class,'book_id');
    }
    public function activeBorrows() {
        return $this->borrows()->where('status', '=', 'ACCEPTED');
    }
    public function genres()
    {
        return $this->belongsToMany(Genre::class,'book_genre',
            'book_id','genre_id');
    }

}
