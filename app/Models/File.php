<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'files';

    protected $fillable = [
        'name',
        'type',
        'location',
        'size',
        'tag',
        'order',
        'model_related_to',
        'model_id'
    ];

    public function fileable()
    {
        return $this->morphTo();
    }
}
