<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetContentStoreElementRequest;
use App\Models\ContentMetadata;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
}
