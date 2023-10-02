<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCategoryCreateRequest;
use App\Http\Requests\AdminCategoryUpdateRequest;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();
        return view('admin.kategori.index', compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bahasa = Language::all();
        return view('admin.kategori.create', compact('bahasa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminCategoryCreateRequest $request)
    {
        $kategori = new Category();
        $kategori->name = $request->name;
        $kategori->slug = \Str::slug($request->name);
        $kategori->language = $request->language;
        $kategori->show_at_nav = $request->show_at_nav;
        $kategori->status = $request->status;
        $kategori->save();

        toast(__('Created Successfully!'), 'success')->width('350');

        return redirect()->route('admin.kategori.index');
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
        $languages = Language::all();
        $kategori = Category::findOrFail($id);
        return view('admin.kategori.edit', compact('languages', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminCategoryUpdateRequest $request, string $id)
    {
        $kategori = Category::findOrFail($id);
        $kategori->name = $request->name;
        $kategori->slug = \Str::slug($request->name);
        $kategori->language = $request->language;
        $kategori->show_at_nav = $request->show_at_nav;
        $kategori->status = $request->status;
        $kategori->save();

        toast(__('Updated Successfully'), 'success')->width('350');

        return redirect()->route('admin.kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return response(['status' => 'success', 'message' => __('Data berhasil dihapus')]);
        } catch (\Throwable $th) {
            return response(['status' => 'error', 'message' => __('Ada yang salah')]);
        }
    }
}
