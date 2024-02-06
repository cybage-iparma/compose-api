<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentMetadata extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'content_id';


    public function getContentStoreElement($request)
    {
        // Define default values for pagination and filters
        $filterName = $request->input('filter_name');
        $filterMimeType = $request->input('filter_mimetype');
        $perPage = $request->input('limit', 10);
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');


        // Build the query
        $query = ContentMetadata::query();

        if ($filterName) {
            $query->whereRaw('LOWER(content_name) LIKE ?', ['%' . strtolower($filterName) . '%']);
        }

        if ($filterMimeType) {
            $query->whereRaw('LOWER(mime_type) LIKE ?', ['%' . strtolower($filterMimeType) . '%']);
        }

        if ($fromDate) {
            $query->where('created_at', '>=', $fromDate . " 00:00:00");
        }
        if ($toDate) {
            $query->where('created_at', '<=', $toDate . " 23:59:59");
        }

        // Apply sorting
        $query->orderBy($sortBy, $sortOrder);

        // Paginate the results
        return $query->paginate($perPage);
    }
    
    public static function saveContentMetadata($file, $csData, $isImage, $videoUrl)
    {
        // Get image dimensions using Intervention Image
        if($isImage){
            $data = getimagesize($file);
             $width = $data[0];
             $height = $data[1];
        }

        // Save content metadata
        $content = new self();
        $content->customer_id = 1; //will be dynamic and will be retrieved from authentication
        $content->element_type = 'file';
        $content->content_url = $isImage ? '' : $videoUrl;
        $content->content_name = $csData['name'];
        $content->is_text = false;
        $content->is_image = $isImage;
        $content->file_name = $file->getClientOriginalName();
        $content->is_public_visible = true;
        $content->is_editable = true;
        $content->description = $csData['description'];
        $content->file_size = $file->getSize();
        $content->mime_type = $file->getMimeType();
        $content->owner_email = 'example@example.com'; //will be removed after confirmation from Michael K.
        $content->owner_first_name = 'John'; //will be removed after confirmation from Michael K.
        $content->owner_last_name = 'Doe'; //will be removed after confirmation from Michael K.
        $content->content_width = $width;
        $content->content_height = $height;
        $content->expiration_automatic = false;
        $content->expiration_days = 0;
        $content->expiration_at = now();
        $content->save();
 
        return $content->content_id;
    }
}
