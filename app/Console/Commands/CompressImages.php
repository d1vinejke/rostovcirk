<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CompressImages extends Command
{
    protected $signature = 'compress:images';
    protected $description = 'Generate thumbnails for images in /storage/gallery/';

    protected ImageManager $imageManager;

    public function __construct()
    {
        parent::__construct();
        $this->imageManager = new ImageManager(new Driver());
    }

    public function handle()
    {
        $sourcePath = storage_path('/app/public/gallery');
        $thumbsPath = storage_path('/app/public/gallery/thumbs');

        // Создаем директорию для миниатюр, если она не существует
        if (!File::exists($thumbsPath)) {
            File::makeDirectory($thumbsPath, 0755, true);
        }

        // Получаем все изображения в директории
        $files = File::allFiles($sourcePath);
        $alreadyCompressed = File::allFiles($thumbsPath);

        // Создаем массив с именами уже сжатых файлов для быстрого поиска
        $compressedFileNames = array_map(function ($file) {
            return $file->getFilename();
        }, $alreadyCompressed);

        foreach ($files as $file) {
            // Проверяем, существует ли уже сжатая версия файла
            if (in_array($file->getFilename(), $compressedFileNames)) {
                $this->info('Skipping already compressed: ' . $file->getFilename());
                continue; // Пропускаем этот файл
            }

            if (in_array($file->getExtension(), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $this->info('Processing: ' . $file->getFilename());

                // Читаем изображение
                $image = $this->imageManager->read($file->getRealPath());
                $image->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $thumbPath = $thumbsPath . '/' . pathinfo($file->getFilename(), PATHINFO_FILENAME) . '.' . pathinfo($file->getFilename(), PATHINFO_EXTENSION);
                $image->save($thumbPath, 70); // Сохраняем с качеством 70

                $this->info('Compressed: ' . $file->getFilename());
            }
        }

        $this->info('Thumbnails generated successfully!');
    }
}
