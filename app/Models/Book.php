<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'title',
        'authors',
        'description',
        'released_at',
        'pages',
        'isbn',
        'in_stock'
    ];
    public function borrows(){
        return $this->hasMany(Borrow::class,'book_id');
    }
    public function activeBorrows() {
        return $this->borrows()->where('status', '=', 'ACCEPTED');
    }
    public function ongoingBorrows() {
        return $this->borrows()->where('status', '!=', 'RETURNED');
    }
    public function genres()
    {
        return $this->belongsToMany(Genre::class,'book_genre',
            'book_id','genre_id');
    }

}
