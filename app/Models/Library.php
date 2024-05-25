<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Library extends Model {

    protected $table = 'libraries';

    protected $fillable = [
        'library_id', 'user_id', 'book_id', 'added_at'
    ];

    protected $primaryKey = 'library_id';

    public $timestamps = false;

    public function book() {
        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }
}