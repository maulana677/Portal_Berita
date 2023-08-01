@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Bahasa</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>Tambah Bahasa</h4>
            </div>
            <div class="card-body">
                <form action="">
                    <div class="form-group">
                        <label for="">Bahasa</label>
                        <select name="" id="" class="form-control">
                            <option value="">--Pilih--</option>
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Slug</label>
                        <input readonly type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Is it default? </label>
                        <select name="" id="" class="form-control">
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="" id="" class="form-control">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </section>
@endsection
