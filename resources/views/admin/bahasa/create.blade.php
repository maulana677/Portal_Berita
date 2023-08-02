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
                <form action="{{ route('admin.bahasa.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Bahasa</label>
                        <select name="lang" id="language-select" class="form-control select2">
                            <option value="">--Pilih--</option>
                            @foreach (config('language') as $key => $lang)
                                <option value="{{ $key }}">{{ $lang['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input readonly name="name" type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="">Slug</label>
                        <input readonly name="slug" type="text" class="form-control" id="slug">
                    </div>
                    <div class="form-group">
                        <label for="">Is it default? </label>
                        <select name="default" id="" class="form-control">
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" id="" class="form-control">
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#language-select').on('change', function() {
                let value = $(this).val();
                let name = $(this).children(':selected').text();
                $('#slug').val(value);
                $('#name').val(name);
            })
        })
    </script>
@endpush
