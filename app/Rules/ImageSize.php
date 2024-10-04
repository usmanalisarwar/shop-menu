<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ImageSize implements Rule
{
    // Method to check the size of the image
    public function passes($attribute, $value)
    {
        // Check if the file exists
        if (!file_exists($value)) {
            return false; // File doesn't exist
        }

        // Get the image dimensions
        list($width, $height) = getimagesize($value);

        // A4 dimensions in pixels (assuming 72 DPI)
        $maxWidth = 595;
        $maxHeight = 842;

        return $width <= $maxWidth && $height <= $maxHeight;
    }

    // Method to return the validation message
    public function message()
    {
        return 'The image must be A4 size or smaller.';
    }
}
