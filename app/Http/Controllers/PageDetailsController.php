<?php

namespace App\Http\Controllers;

use App\Models\PageDetails;
use Illuminate\Http\Request;

class PageDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_history = PageDetails::join('users', 'page_details.user_id', '=', 'users.id')->get();
        return view('pages.page-details.index', [
            'page_history' => $page_history
        ]);
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
        $updated = false;
        foreach ($request->page_details as $field => $detail) {
            $page_update = PageDetails::updateOrcreate(
                [
                    'page_name' => $request->page_name ?: substr($request->getRequestUri(), 1),
                    'page_field' => str_replace( '\'', '', $field),
                    'page_tag' => $request->page_tag?: null,
                    'user_id' => auth()->user()->id,
                    'published' => $request->published?: true,
                    'page_details' => $detail
                ],
                []
            );
            $updated = $updated || !!$page_update;
        }

        return back()->with([
            'updated' => $updated? 'Data updated successfully': 'Data update failed'
        ], $updated? 200: 400);
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

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request){
        $page_history = PageDetails::select('page_details.*')
            ->whereIn('page_details.updated_at', function ($query) {
                $query->selectRaw('MAX(updated_at)')
                    ->from('page_details')
                    ->groupBy('page_field');
            })
            ->join('users', 'page_details.user_id', '=', 'users.id');

        if ($request->page_name) {
            $page_history->where('page_name', $request->page_name);
        }

        $page_history = $page_history->get();


        return $page_history;

    }
}
