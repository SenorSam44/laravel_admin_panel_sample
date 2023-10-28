<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'client_id',
        'start_date',
        'end_date',
        'status',
        'category',
        'team_members',
        'budget',
        'tags',
        'progress',
        'description',
        'published',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'budget' => 'integer',
        'progress' => 'integer',
        'published' => 'boolean'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
