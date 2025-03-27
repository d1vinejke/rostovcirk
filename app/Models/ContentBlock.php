<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentBlock extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'description'
    ];

    const TYPES = [
        'text' => 'Текст',
        'html' => 'HTML',
        'image' => 'Изображение',
        'file' => 'Файл',
        'json' => 'JSON данные'
    ];
}
