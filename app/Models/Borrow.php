<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;
    protected $fillable = [
        'reader_id',
        'book_id',
        'status',
        'request_process_at',
        'request_managed_at',
        'deadline',
        'returned_at',
        'return_managed_by'
    ];
    public function book(){
        return $this->belongsTo(Book::class);
    }
    public function reader(){
        return $this->belongsTo(User::class,'reader_id');
    }
    public function managedRequests(){
        return $this->belongsTo(User::class,'request_managed_by');
    }
    public function managedReturns(){
        return $this->belongsTo(User::class,'return_managed_by');
    }
}
