@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Kategori') }}</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Edit Kategori') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="">{{ __('Bahasa') }}</label>
                        <select name="language" id="language-select" class="form-control select2">
                            <option value="">--{{ __('Pilih') }}--</option>
                            @foreach ($languages as $lang)
                                <option {{ $lang->lang === $kategori->language ? 'selected' : '' }}
                                    value="{{ $lang->lang }}">
                                    {{ $lang->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('language')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Name') }}</label>
                        <input name="name" value="{{ $kategori->name }}" type="text" class="form-control"
                            id="name">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Show at Nav') }} </label>
                        <select name="show_at_nav" id="" class="form-control">
                            <option {{ $kategori->show_at_nav === 0 ? 'selected' : '' }} value="0">
                                {{ __('Tidak') }}</option>
                            <option {{ $kategori->show_at_nav === 1 ? 'selected' : '' }} value="1">
                                {{ __('Ya') }}</option>
                        </select>
                        @error('default')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('Status') }}</label>
                        <select name="status" id="" class="form-control">
                            <option {{ $kategori->status === 1 ? 'selected' : '' }} value="1">{{ __('Aktif') }}
                            </option>
                            <option {{ $kategori->status === 0 ? 'selected' : '' }} value="0">{{ __('Nonaktif') }}
                            </option>
                        </select>
                        @error('status')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Ubah') }}</button>
                </form>
            </div>
        </div>
    </section>
@endsection
