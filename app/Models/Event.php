<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'event_date', 'location', 'image_path', 'is_published'];

    protected $casts = [
        'is_published' => 'boolean',
        'event_date' => 'datetime'
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public static function GetById(int $id)
    {
        return Event::where('id', $id)->first();
    }

    public static function GetAllWithExcept(int $exceptId)
    {
        return Event::where('id', '!=', $exceptId)->latest()->take(3)->get();
    }
}
