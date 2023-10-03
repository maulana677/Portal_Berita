<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FooterGridOneSaveRequest;
use App\Models\FooterGridThree;
use App\Models\Language;
use Illuminate\Http\Request;

class FooterGridThreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        return view('admin.footer-grid-three.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bahasa = Language::all();
        return view('admin.footer-grid-three.create', compact('bahasa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FooterGridOneSaveRequest $request)
    {
        $footer = new FooterGridThree();
        $footer->language = $request->language;
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();

        toast(__('Created Successfully!'), 'success');

        return redirect()->route('admin.footer-grid-three.index');
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
        $bahasa = Language::all();
        $footer = FooterGridThree::findOrFail($id);
        return view('admin.footer-grid-three.edit', compact('footer', 'bahasa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FooterGridOneSaveRequest $request, string $id)
    {
        $footer = FooterGridThree::findOrFail($id);
        $footer->language = $request->language;
        $footer->name = $request->name;
        $footer->url = $request->url;
        $footer->status = $request->status;
        $footer->save();

        toast(__('Updated Successfully!'), 'success');

        return redirect()->route('admin.footer-grid-three.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        FooterGridThree::findOrFail($id)->delete();

        return response(['status' => 'success', 'message' => __('Deleted Successfully!')]);
    }
}
