<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Bookmark extends Model
{
    protected $connection = 'mongodb';
    protected $table = 'readingprogress';

    protected $fillable = [
        'userId',
        'bookId',
        'currentPage',
        'lastReadAt',
    ];
}
