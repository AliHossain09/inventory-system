<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductImageService
{
    public function store(?UploadedFile $file): ?string
    {
        if (!$file) {
            return null;
        }

        return $file->store('products', 'public');
    }

    public function update(?UploadedFile $file, ?string $oldImage): ?string
    {
        if (!$file) {
            return $oldImage;
        }

        if ($oldImage && Storage::disk('public')->exists($oldImage)) {
            Storage::disk('public')->delete($oldImage);
        }

        return $file->store('products', 'public');
    }

    public function delete(?string $image): void
    {
        if ($image && Storage::disk('public')->exists($image)) {
            Storage::disk('public')->delete($image);
        }
    }
}
