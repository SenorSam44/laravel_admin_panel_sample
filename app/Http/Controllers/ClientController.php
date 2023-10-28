<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\File;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private $attributes = [
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
        'status',
        'published',
        'description',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        $attributes = [
            'first_name',
            'last_name',
            'logo',
            'company_name',
            'website',
            'status',
            'published',
        ];

        return view('pages.client.index', compact(['clients', 'attributes']));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.client.create', [
            'attributes' => $this->attributes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request);
        $id = is_numeric($request->id) ? $request->id : null;

        // Prepare the data to be used for updating or creating the expense
        $clientData = [];
        foreach ($this->attributes as $attribute){
            $clientData[$attribute] = $request->$attribute;
        }
        // Editing an existing project
        $client = Client::updateOrcreate(['id' => $id], $clientData);
        if (!$client){
            return back()->with('error', 'Failed to ' . ($id ? 'update' : 'create') . ' the client');
        }
        return back()->with('status', 'Client ' . ($id ? 'updated' : 'created') . ' successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::find($id);
        return view('pages.client.show', [
            'client'=>$client,
            'attributes' => $this->attributes,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = Client::find($id);
        $client_files = File::where('model_related_to', 'client')->where('model_id', $id)->get();
        return view('pages.client.create', [
            'attributes' => $this->attributes,
            'client' => $client,
            'files' => $client_files
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
        $client = Client::find($id);
        if (!$client) {
            return redirect()->route('clients.index')->with('message', 'Client not found.');
        }
        $client->delete();
        return redirect()->route('clients.index')->with('message', 'Client deleted successfully');
    }
}
