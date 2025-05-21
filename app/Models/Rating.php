<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
     protected $fillable = [
        'average_rating',
        'voter',
    ];
     public function book()
    {
        return $this->hasOne(Book::class);
    }
}
