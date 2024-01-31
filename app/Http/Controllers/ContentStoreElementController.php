<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetContentStoreElementRequest;
use App\Models\ContentMetadata;
use Illuminate\Http\Request;

class ContentStoreElementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetContentStoreElementRequest $request)
    {
        // Define default values for pagination and filters
        $filterName = $request->input('filter_name');
        $filterMimeType = $request->input('filter_mimetype');
        $perPage = $request->input('limit', 20);
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
        $contentMetadata = $query->paginate($perPage);
        // dd($contentMetadata);

        $response = [];
        if (!empty($contentMetadata)) {
            foreach ($contentMetadata as $k => $val) {
                // dd($contentMetadata);
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
                $data[$k]['owner']['email'] = $val->owner_email;
                $data[$k]['owner']['firstName'] = $val->owner_first_name;
                $data[$k]['owner']['lastName'] = $val->owner_last_name;
                $data[$k]['dimensions']['width'] = $val->content_width;
                $data[$k]['dimensions']['height'] = $val->content_height;
                $data[$k]['mimeType'] = $val->mime_type;
                $data[$k]['expirationAutomatic'] = $val->expiration_automatic;
                $response['data'] = $data;
            }
            $response['total'] = $contentMetadata->total();
            $response['count'] = $contentMetadata->perPage();
            $response['page'] = $contentMetadata->currentPage();
        }

        // return response()->json($contentMetadata);
        return response()->json($response);
    }
}
