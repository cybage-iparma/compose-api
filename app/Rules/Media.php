<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

class Media implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $is_image = Validator::make(
            ['upload' => $value],
            ['upload' => 'image']
        )->passes();

        $is_video = Validator::make(
            ['upload' => $value],
            ['upload' => 'mimetypes:video/avi,video/mpeg,video/quicktime']
        )->passes();

        if (!$is_video && !$is_image) {
            $fail(':attribute must be image or video.');
        }

        if ($is_video) {
            $validator = Validator::make(
                ['video' => $value],
                ['video' => "max:102400"]
            );
            if ($validator->fails()) {
                $fail(":attribute must be 10 megabytes or less.");
            }
        }

        if ($is_image) {
            $validator = Validator::make(
                ['image' => $value],
                ['image' => "max:1024"] //will change as per the value in feature table (Need to work on this)
            );
            if ($validator->fails()) {
                $fail(":attribute must be one megabyte or less.");
            }
        }
    }
}
