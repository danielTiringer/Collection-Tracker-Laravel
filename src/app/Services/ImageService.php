<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function store(UploadedFile $file): string
    {
        return $file->store('images', 'public');
    }

    public function destroy(string $filePath): bool
    {
        return Storage::disk('public')->delete($filePath);
    }
}
