<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentMetadata extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'content_id';

    /**
     * Get the user that owns the phone.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(MappCloudCustomer::class, 'customer_id', 'cloud_id');
    }


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

        // Get the total count of records before pagination
        $totalCount = $query->count();

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
        $filteredData = $query->paginate($perPage);
        $filteredData->totalCount = $totalCount;
        return $filteredData;
    }
}
