<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes; // Add SoftDeletes trait

    protected $table = 'expenses'; // Specify the table name if different

    protected $fillable = [
        'date',
        'description',
        'category',
        'amount',
    ];

    protected $dates = ['deleted_at']; // Specify the column for soft delete

    protected $casts = [
        'date' => 'datetime',
        'amount' => 'integer',
    ];

}
