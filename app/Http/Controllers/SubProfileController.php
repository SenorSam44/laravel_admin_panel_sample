<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class SubProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.laravel-examples.user-management');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.subprofile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::updateOrcreate(
            [
                'id' => $request->id,
            ],
            [
                'email' => $request->email,
                'name' => $request->name,
                'password' => $request->has('password') ? bcrypt($request->password) : null,
                'phone' => $request->phone,
                'about' => $request->about,
                'role' => $request->role,
                'position' => $request->position,
            ]
        );

        return back()->with(['success' => !!$user, 'status' => $user? 'Profile successfully updated': 'Profile update failed']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('pages.subprofile.create', [
            'user' => User::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pages.subprofile.create', [
            'user' => User::findOrFail($id)
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the expense by its ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('pages.laravel-examples.user-management')->with('error', 'User not found.');
        }

        $user->delete();
        return redirect()->route('pages.laravel-examples.user-management')->with('success', 'User deleted successfully.');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = $request->name . $file->clientExtension();
            $file->storeAs('public/images/user', $fileName); // Store in the public folder

            // You can save the file path in the database or use it as needed
            // For example, save $fileName in a 'images' column in your database table.
            return response()->json(['success' => true, 'message' => 'Image uploaded successfully']);
        }
    }
}
