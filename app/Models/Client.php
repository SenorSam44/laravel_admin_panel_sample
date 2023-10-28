<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'address',
        'logo',
        'company_name',
        'contact_name',
        'contact_email',
        'website',
        'industry',
        'description',
        'status',
        'published',
    ];

    protected $casts = [
        'budget' => 'integer',
        'progress' => 'integer',
    ];


}
