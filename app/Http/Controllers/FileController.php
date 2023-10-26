<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        $file = File::find($id);
        // Check if the user has permission to delete the file (e.g., ownership check)

        // Specify the file location
//        $location = 'public/uploads/' . $file->location; // Adjust the path as needed

//        dd(Storage::disk('local')->exists($file->location));

        // Check if the file exists before attempting to delete
        if (Storage::disk('local')->exists($file->location)) {
            // Delete the file
            Storage::disk('local')->delete($file->location);
            // You can also delete the associated database record if necessary
        }
        $file->delete();
        return response()->json(['message' => 'File deleted successfully']);
    }

    public function upload(Request $request)
    {
        $files = $request->file('files');
        $modelRelatedTo = $request->input('model_related_to');
        $modelId = $request->input('model_id');

        foreach ($files as $file) {
            // Handle file upload and storage
            $path = $file->store('public/uploads'); // Adjust the storage path as needed

            // Create a file record in the database
            $file = File::create([
                'name' => $file->getClientOriginalName(),
                'type' => $file->getClientMimeType(),
                'location' => $path,
                'size' => $file->getSize(),
                'tag' => $request->input('tag'),
                'model_related_to' => $modelRelatedTo,
                'model_id' => $modelId,
            ]);

        }

        return response()->json(['message' => 'Files uploaded successfully.']);
    }
}
