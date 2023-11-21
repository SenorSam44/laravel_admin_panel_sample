<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    private $attributes = [
        'to_name',
        'to_phone_number',
        'to_address',
//        'invoice_number', (auto generated)
        'vat_percentage',
        'payment_method',
        'account_bank',
        'account_no',
        'account_name',
        'transaction_number',
//        'user_id',
    ];

    private $invoice_attributes_options = [
        'payment_method' => ['cash', 'bank_payment'],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $invoices = Invoice::all();

        foreach ($invoices as $invoice) {
            $invoice->total_amount = $invoice->invoiceItems()->sum('total') * (1 + ($invoice->vat_percentage/100));
        }

        return view('pages.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create(Request $request)
    {
        return view('pages.invoices.create', [
            'attributes' => $this->attributes,
            'invoice_attributes_options' => $this->invoice_attributes_options,
        ]);
    }

    /**
     * Store new or Update the specified resource in storage.
     */
    public function store(Request $request)
    {
        $id = is_numeric($request->id) ? $request->id : null;

        // Prepare the data to be used for updating or creating the expense
        $invoiceData = [];
        foreach ($this->attributes as $attribute) {
            $invoiceData[$attribute] = $request->$attribute;
        }
        $invoiceData["user_id"] = auth()->user()->id;

        if ($invoiceData['payment_method'] == 'cash') {
            $invoiceData["account_no"] = null;
            $invoiceData['account_name'] = null;
            $invoiceData['transaction_number'] = null;
        }


        // Editing an existing project
        $invoice = Invoice::updateOrcreate(['id' => $id], $invoiceData);

        // Handle invoice items
        $itemsData = $request->input('items');
        if ($itemsData) {
            // Delete existing items (if any)
            $invoice->invoiceItems()->delete();

            // Create new items
            foreach ($itemsData as $item) {
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                ]);
            }
        }

        if (!$invoice) {
            return back()->with('error', 'Failed to ' . ($id ? 'update' : 'create') . ' the invoice');
        }
        return back()->with('status', 'Invoice ' . ($id ? 'updated' : 'created') . ' successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = Invoice::find($id);
        $invoice_items = $invoice->invoiceItems()->get();
        return view('pages.invoices.show', [
            'attributes' => $this->attributes,
            'invoice' => $invoice,
            'invoice_items' => $invoice_items,
            'invoice_attributes_options' => $this->invoice_attributes_options,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $invoice = Invoice::find($id);
        $invoice_items = $invoice->invoiceItems()->get();
        return view('pages.invoices.create', [
            'attributes' => $this->attributes,
            'invoice' => $invoice,
            'invoice_items' => $invoice_items,
            'invoice_attributes_options' => $this->invoice_attributes_options,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }

    public function generatePdf(Request $request, $invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        $invoiceItems = $invoice->invoiceItems()->get();

        // Assuming you have an 'invoice_pdf.blade.php' view
        $pdf = PDF::loadView('pages.invoices.invoice_pdf', compact(['invoice', 'invoiceItems']));

        // Return the PDF as a download or inline display
        return $pdf->download('invoice.pdf');
    }

    public function webviewPdf($invoiceId)
    {
        $invoice = Invoice::find($invoiceId);
        $invoiceItems = $invoice->invoiceItems()->get();
//        dd($invoice);
        $invoice->from_name = "From name";
        $invoice->from_address = "Static Form address";
        $invoice->from_phone_number = "From static phone number";
        $invoice->sub_total_amount = $invoice->invoiceItems()->sum('total');
        $invoice->vat_amount = $invoice->invoiceItems()->sum('total') * ($invoice->vat_percentage/100);
        $invoice->total_amount = $invoice->invoiceItems()->sum('total') * (1 + ($invoice->vat_percentage/100));

        return view("pages.invoices.invoice_pdf", compact(['invoice', 'invoiceItems']));
    }
}
