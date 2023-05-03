<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class ValidImageMime implements Rule
{
    public function passes($attribute, $value)
    {
        if (is_array($value)) {
            foreach ($value as $file) {
                if (!$this->validateFile($file)) {
                    return false;
                }
            }
            return true;
        } else {
            return $this->validateFile($value);
        }
    }

    protected function validateFile($file)
    {
        if (!$file instanceof UploadedFile) {
            return false;
        }

        $imageData = getimagesize($file->getRealPath());

        if (!$imageData) {
            return false;
        }

        $mime = $imageData['mime'];
        $validMimes = [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp',
        ];

        if (!in_array($mime, $validMimes)) {
            return false;
        }

        $image = Image::make($file)->encode('data-url');
        $dataUrl = $image->__toString();

        if (strpos($dataUrl, 'data:image/') !== 0) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return 'El archivo debe ser una imagen válida.';
    }
}
