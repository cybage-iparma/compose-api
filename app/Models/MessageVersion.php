<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageVersion extends Model
{
    use HasFactory;


    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'version_id';
}
