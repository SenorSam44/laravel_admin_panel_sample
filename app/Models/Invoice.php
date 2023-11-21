<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'to_name',
        'to_address',
        'to_phone_number',
        'invoice_number',
        'vat_percentage',
        'payment_method',
        'account_no',
        'account_name',
        'account_bank',
        'transaction_number',
        'user_id',
    ];

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            $invoicePrefix = env('INVOICE_PREFIX', 0); // Retrieve the fixed number from .env
            $invoice->invoice_number = strtoupper(sprintf('%06d%s', $invoicePrefix, Str::random(8)));
        });
    }
}
