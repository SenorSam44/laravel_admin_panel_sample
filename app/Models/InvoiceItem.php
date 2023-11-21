<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'name',
        'quantity',
        'unit_price',
        'total',
    ];

    // Relationship with the Invoice model
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($invoiceItem) {
            $invoiceItem->total = ceil( floatval($invoiceItem->unit_price) * $invoiceItem->quantity);
        });
    }
}
