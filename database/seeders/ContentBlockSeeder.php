<?php


namespace Database\Seeders;

use App\Models\ContentBlock;
use Illuminate\Database\Seeder;

class ContentBlockSeeder extends Seeder
{
    public function run(): void
    {
        $blocks = [
            [
                'key' => 'main_phone',
                'description' => 'Основной телефон',
                'type' => 'text',
                'group' => 'Контакты'
            ],
            [
                'key' => 'main_email',
                'description' => 'Основной Email',
                'type' => 'text',
                'group' => 'Контакты'
            ],
            [
                'key' => 'main_banner__name',
                'description' => 'Название',
                'type' => 'text',
                'group' => 'Общие'
            ],
            [
                'key' => 'main_banner__subtitle',
                'description' => 'Слоган',
                'type' => 'text',
                'group' => 'Общие'
            ],
            [
                'key' => 'main_banner__description',
                'description' => 'Описание',
                'type' => 'html',
                'group' => 'Общие'
            ],
            [
                'key' => 'main_logo',
                'description' => 'Логотип',
                'type' => 'image',
                'group' => 'Общие'
            ],
            [
                'key' => 'about_text',
                'description' => 'Текст на странице "О нас"',
                'type' => 'html',
                'group' => 'Страницы'
            ],
        ];

        foreach($blocks as $block) {
            ContentBlock::firstOrCreate(
                ['key' => $block['key']],
                $block
            );
        }
    }
}
