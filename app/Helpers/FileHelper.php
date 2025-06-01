<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileHelper
{
    public static function uploadToStorage($file, string $folder = 'uploads', array $allowedExtensions = ['jpg', 'png', 'jpeg', 'pdf', 'gif'], string $disk = 'public'): ?string
    {
        $extension = strtolower($file->getClientOriginalExtension());
        if ($extension == null) {
            # code...
            $extension = 'webp';
        }
        // if (!in_array($extension, $allowedExtensions)) {
        //     return null; // Invalid extension
        // }
        $filename = Str::uuid() . '.' . $extension;
        $path = $file->storeAs($folder, $filename, $disk);
        return $path;
    }

    public static function deleteFromStorage(string $path): bool
    {
        return Storage::disk('public')->delete($path);
    }
}
