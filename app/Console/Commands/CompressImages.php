<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;
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

        foreach ($files as $file) {
            foreach ($alreadyCompressed as $compressedFile) {
                if($file->getFilename() != $compressedFile->getFilename()) {
                    if (in_array($file->getExtension(), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                        $this->info('Processing: ' . $file->getFilename());

                        $image = $this->imageManager->read($file->getRealPath());
                        $image->scale(400, 400, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        });
                        $image->toWebp(70);

                        $thumbPath = $thumbsPath . '/' . $file->getFilename();
                        $image->save($thumbPath);

                        $this->info('Compressed: ' . $compressedFile->getFilename());
                    }
                }
            }
        }

        $this->info('Thumbnails generated successfully!');
    }
}
