<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageTemplate extends Model
{
    use HasFactory;


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'template_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['customer_id', 'message_category_id', 'template_name', 'template_content_json', 'template_content_mjml'];
}
