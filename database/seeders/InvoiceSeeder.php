<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 invoices
        $invoices = Invoice::factory( )->count(10)->create();

        // For each invoice, create 3 invoice items
        $invoices->each(function ($invoice) {
            InvoiceItem::factory()->count( 5)->create([
                'invoice_id' => $invoice->id,
            ]);
        });
    }
}
