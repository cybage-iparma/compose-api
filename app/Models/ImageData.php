<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageData extends Model
{
    use HasFactory;
    
    protected $table = 'image_data';
    protected $primaryKey = 'image_id';
 
    protected $fillable = [
        'content_id',
        'image_data',
    ];
 
    // Define relationships if needed
    public function contentMetadata()
    {
        return $this->belongsTo(ContentMetadata::class, 'content_id');
    }
    
    public static function saveImageData($contentId, $file)
    {
        // Save content_id and image_data in image_data table
        $imageData = new self();
        $imageData->content_id = $contentId;
        $imageData->image_data = base64_encode(file_get_contents($file)); 
        $imageData->save();
    }
}