@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Language') }}</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.Update Languages') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.bahasa.update', $bahasa->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">{{ __('admin.Language') }}</label>
                        <select name="lang" id="language-select" class="form-control select2" style="width: 100%;">
                            <option value="">--{{ __('admin.Select') }}--</option>
                            @foreach (config('language') as $key => $lang)
                                <option @if ($bahasa->lang === $key) selected @endif value="{{ $key }}">
                                    {{ $lang['name'] }}</option>
                            @endforeach
                        </select>
                        @error('lang')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Name') }}</label>
                        <input readonly name="name" value="{{ $bahasa->name }}" type="text" class="form-control"
                            id="name">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Slug') }}</label>
                        <input readonly name="slug" value="{{ $bahasa->slug }}" type="text" class="form-control"
                            id="slug">
                        @error('slug')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Is it default?') }} </label>
                        <select name="default" id="" class="form-control">
                            <option {{ $bahasa->default === 0 ? 'selected' : '' }} value="0">{{ __('admin.No') }}
                            </option>
                            <option {{ $bahasa->default === 1 ? 'selected' : '' }} value="1">{{ __('admin.Yes') }}
                            </option>
                        </select>
                        @error('default')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">{{ __('admin.Status') }}</label>
                        <select name="status" id="" class="form-control">
                            <option {{ $bahasa->status === 1 ? 'selected' : '' }} value="1">{{ __('admin.Active') }}
                            </option>
                            <option {{ $bahasa->status === 0 ? 'selected' : '' }} value="0">
                                {{ __('admin.Inactive') }}
                            </option>
                        </select>
                        @error('status')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('admin.Update') }}</button>
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
