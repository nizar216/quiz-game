<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'category_id', 'content', 'answer', 'difficulty', 'choices', 'hint'
    ];

    protected $casts = [
        'choices' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function rounds()
    {
        return $this->hasMany(Round::class);
    }
}
