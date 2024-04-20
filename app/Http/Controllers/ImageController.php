<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ImageController extends Controller
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
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        $this->authorize('update', $image);
        
        return view('tools.editImg', [
            'image' => $image,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image): RedirectResponse
    {
        $this->authorize('update', $image);

        $validated = $request->validate([
            'url' => 'required|file|mimes:png,jpeg,jpg|max:2048',
        ]);
        
        $request->url->move(public_path('images'), $image->url);

        return redirect(route('tools.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        //
    }
}
/*
    public function editImg(tool $tool): View
    {
        $this->authorize('updateImg', $tool);
        
        return view('tools.editImg', [
            'tool' => $tool,
        ]);
    }

    public function updateImg(Request $request, tool $tool): RedirectResponse
    {
        $this->authorize('updateImg', $tool);

        $validated = $request->validate([
            'image_url' => 'required|file|mimes:png,jpeg,jpg|max:2048',
        ]);
        
        $image_name = time().'.'.Str::random(5).'.'.$request->image_url->extension();
        $request->image_url->move(public_path('images'), $image_name);
        $validated['image_url'] = $image_name;
        $request->user()->tools()->update($validated);

        return redirect(route('tools.index'));
    }
    */