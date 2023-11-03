<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLanguageStoreRequest;
use App\Http\Requests\AdminLanguageUpdateRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:languages index,admin'])->only(['index']);
        $this->middleware(['permission:languages create,admin'])->only(['create', 'store']);
        $this->middleware(['permission:languages update,admin'])->only(['edit', 'update']);
        $this->middleware(['permission:languages delete,admin'])->only(['destroy']);
    }

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

        toast(__('admin.Created Successfully'), 'success')->width('350');

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
        $bahasa = Language::findOrFail($id);
        return view('admin.bahasa.edit', compact('bahasa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminLanguageUpdateRequest $request, string $id)
    {
        $bahasa = Language::findOrFail($id);
        $bahasa->name = $request->name;
        $bahasa->lang = $request->lang;
        $bahasa->slug = $request->slug;
        $bahasa->default = $request->default;
        $bahasa->status = $request->status;
        $bahasa->save();

        toast(__('admin.Data berhasil diperbarui'), 'success')->width('350');

        return redirect()->route('admin.bahasa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $bahasa = Language::findOrFail($id);
            if ($bahasa->lang === 'en') {
                return response(['status' => 'error', 'message' => __('admin.Tidak dapat menghapus data yang ini')]);
            }
            $bahasa->delete();
            return response(['status' => 'success', 'message' => __('admin.Data berhasil dihapus!')]);
        } catch (\Throwable $th) {
            return response(['status' => 'error', 'message' => __('admin.something went wrong!')]);
        }
    }
}
