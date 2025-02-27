<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class GalleryController extends Controller
{
    private ImageManager $imageManager;

    public function __construct()
    {
        // Инициализация драйвера
        $this->imageManager = new ImageManager(new Driver());
    }

    public function index()
    {
        $galleries = Gallery::latest()->paginate(12);
        return view('galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);

        $image = $request->file('image');
        $imagePath = $this->processImage($image);

        Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath
        ]);

        return redirect()->route('galleries.index')
            ->with('success', 'Изображение успешно добавлено');
    }

    public function edit(Gallery $gallery)
    {
        return view('galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $gallery->image_path);

            $image = $request->file('image');
            $imagePath = $this->processImage($image);

            $data['image_path'] = $imagePath;
        }

        $gallery->update($data);

        return redirect()->route('galleries.index')
            ->with('success', 'Изображение обновлено');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::delete('public/' . $gallery->image_path);
        $gallery->delete();

        return redirect()->route('galleries.index')
            ->with('success', 'Изображение удалено');
    }

    private function processImage($image): string
    {
        $filename = uniqid() . '.webp';
        $path = 'gallery/' . $filename;
        $thumbPath = 'gallery/thumbs/' . $filename;

        // Основное изображение
        $this->processImageSize($image, $path, 1920, 1080, 80);

        // Миниатюра
        $this->processImageSize($image, $thumbPath, 400, 400, 70);

        return $path;
    }

    private function processImageSize($image, string $path, int $width, int $height, int $quality): void
    {
        $image = $this->imageManager->read($image);

        $image->scale($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $image->toWebp($quality);

        Storage::disk('public')->put(
            $path,
            $image->encode()
        );
    }
}
