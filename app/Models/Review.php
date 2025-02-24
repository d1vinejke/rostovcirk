<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_name', 'is_approved'];

    protected $casts = [
        'is_approved' => 'boolean',
        'event_date' => 'datetime'
    ];

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeUnapproved($query)
    {
        return $query->where('is_approved', false);
    }
}
