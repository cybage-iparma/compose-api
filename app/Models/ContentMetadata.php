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
}
