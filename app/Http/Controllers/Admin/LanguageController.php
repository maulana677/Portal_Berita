<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLanguageStoreRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $bahasa = Language::all();
        return view('admin.bahasa.index', compact('bahasa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bahasa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminLanguageStoreRequest $request)
    {
        $bahasa = new Language();
        $bahasa->name = $request->name;
        $bahasa->lang = $request->lang;
        $bahasa->slug = $request->slug;
        $bahasa->default = $request->default;
        $bahasa->status = $request->status;
        $bahasa->save();

        toast( __('Data berhasil di simpan'),'success')->width('350');

        return redirect()->route('admin.bahasa.index');
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
        //
    }
}
