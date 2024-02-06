<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetContentStoreElementRequest;
use App\Http\Requests\CreateContentStoreElementRequest;
use App\Models\ContentMetadata;
use App\Models\ImageData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ContentStoreElementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetContentStoreElementRequest $request)
    {

        $contentMetadataObj = new ContentMetadata();
        $contentMetadata = $contentMetadataObj->getContentStoreElement($request);

        $response = [];
        if (!empty($contentMetadata)) {
            foreach ($contentMetadata as $k => $val) {

                // $startDate = Carbon::parse($val->created_at);
                // $endDate = Carbon::parse($val->expiration_at);

                // // Calculate the difference in days
                // $daysDifference = $startDate->diffInDays($endDate);

                $data[$k]['id'] = $val->content_id;
                $data[$k]['elementType'] = $val->element_type;
                $data[$k]['url'] = $val->content_url;
                $data[$k]['name'] = $val->content_name;
                $data[$k]['creationDate'] = $val->created_at;
                $data[$k]['expirationDate'] = $val->expiration_at;
                $data[$k]['lastModificationDate'] = $val->updated_at;
                $data[$k]['expirationDays'] = $val->expiration_days;
                $data[$k]['isText'] = $val->is_text;
                $data[$k]['isImage'] = $val->is_image;
                $data[$k]['fileName'] = $val->file_name;
                $data[$k]['publicVisible'] = $val->is_public_visible;
                $data[$k]['canEdit'] = $val->is_editable;
                $data[$k]['description'] = $val->description;
                $data[$k]['fileSize'] = $val->file_size;
                $data[$k]['dimensions']['width'] = $val->content_width;
                $data[$k]['dimensions']['height'] = $val->content_height;
                $data[$k]['mimeType'] = $val->mime_type;
                $data[$k]['expirationAutomatic'] = $val->expiration_automatic;
                $response['data'] = $data;
            }
            $response['totalCount'] = $contentMetadata->totalCount;
            $response['total'] = $contentMetadata->total();
            $response['count'] = $contentMetadata->perPage();
            $response['page'] = $contentMetadata->currentPage();
        }

        return response()->json($response);
    }

    public function createContentStoreElement(CreateContentStoreElementRequest $request)
    {
        try{
            $file = $request->file('file');
            $contentElementData['name'] = $request->input('name');
            $contentElementData['description'] = $request->input('description');

            $response = [];

            // Check if it's an image or video
            $isImage = Str::startsWith($file->getMimeType(), 'image');

            if ($isImage) {
                $contentId = ContentMetadata::saveContentMetadata($file, $contentElementData, true, '');
                ImageData::saveImageData($contentId,$file);
            } else {
                $videoUrl = $this->uploadToAWS($file);
                ContentMetadata::saveContentMetadata($file, $contentElementData, false, $videoUrl);
            }

            $response = [
                'status_code' => 200,
                'msg' => 'Content uploaded successfully'
            ];
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Image upload failed: ' . $e->getMessage());

            $response = [
                'status_code' => 500,
                'msg' => 'Image upload failed'
            ];
        }

        return response()->json($response);
    }
  
    private function uploadToAWS($file)
    {
        $bucket = 'your-s3-bucket-name';

        // Generate a unique filename for the uploaded file
        $filename = $file->getClientOriginalExtension();

        // Upload the file to AWS S3
        Storage::disk('s3')->putFileAs('', $file, $filename, 'public');

        // Return the URL of the uploaded file
        return Storage::disk('s3')->url($filename);
    }
}
 
