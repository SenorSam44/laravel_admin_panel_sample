<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes; // Add SoftDeletes trait

    const TYPE_EXPENSE = 'expense';
    const TYPE_INCOME = 'income';

    protected $table = 'expenses'; // Specify the table name if different

    protected $fillable = [
        'date',
        'description',
        'category',
        'amount',
        'type'
    ];

    protected $dates = ['deleted_at']; // Specify the column for soft delete

    protected $casts = [
        'date' => 'datetime',
        'amount' => 'integer',
        'type' => 'integer'
    ];

}
