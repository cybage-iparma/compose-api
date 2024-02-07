<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Message extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'message_id';


    public function messageTags(): HasMany
    {
        return $this->hasMany(MessageTag::class, 'message_id', 'message_id');
    }

    public function messageCategory(): BelongsTo
    {
        return $this->belongsTo(MessageCategory::class, 'message_category_id', 'message_category_id');
    }
}
