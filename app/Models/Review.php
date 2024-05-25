<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {

    protected $table = 'reviews';

    protected $fillable = [
        'review_id', 'user_id', 'book_id', 'rating', 'comment', 'created_at'
    ];
    
    protected $primaryKey = 'review_id';

    public $timestamps = false;

    public function book() {
        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }
}