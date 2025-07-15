<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService
{
    public function upload($image): string
    {
        $extension = $image->extension();
        $image_name = Str::random(20) . '.' . $extension;

        $image->storeAs('public/uploads', $image_name);

        $image_path = 'storage/uploads/' . $image_name;

        return $image_path;
    }

    public function delete($image_path): void
    {
        $storage_path = str_replace('storage/', 'public/', $image_path);
        Storage::delete($storage_path);
    }
}