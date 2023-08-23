@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Berita') }}</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('Semua Berita') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Tambah') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                    @foreach ($languages as $language)
                        <li class="nav-item">
                            <a class="nav-link {{ $loop->index === 0 ? 'active' : '' }}" id="home-tab2" data-toggle="tab"
                                href="#home-{{ $language->lang }}" role="tab" aria-controls="home"
                                aria-selected="true">{{ $language->name }}</a>
                        </li>
                    @endforeach

                </ul>
                <div class="tab-content tab-bordered" id="myTab3Content">
                    {{--  @foreach ($languages as $language)
                        @php
                            $categories = \App\Models\Category::where('language', $language->lang)
                                ->orderByDesc('id')
                                ->get();
                        @endphp
                        <div class="tab-pane fade show {{ $loop->index === 0 ? 'active' : '' }}"
                            id="home-{{ $language->lang }}" role="tabpanel" aria-labelledby="home-tab2">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-{{ $language->lang }}">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>{{ __('Bahasa') }}</th>
                                                <th>{{ __('Kode Bahasa') }}</th>
                                                <th>{{ __('In Nav') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td>{{ $category->id }}</td>
                                                    <td>{{ $category->name }}</td>
                                                    <td>{{ $category->language }}</td>
                                                    <td>
                                                        @if ($category->show_at_nav == 1)
                                                            <span class="badge badge-primary">{{ __('Ya') }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ __('Tidak') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($category->status == 1)
                                                            <span class="badge badge-success">{{ __('Ya') }}</span>
                                                        @else
                                                            <span class="badge badge-danger">{{ __('Tidak') }}</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('admin.kategori.edit', $category->id) }}"
                                                            class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                        <a href="{{ route('admin.kategori.destroy', $category->id) }}"
                                                            class="btn btn-danger delete-item"><i
                                                                class="fas fa-trash-alt"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach  --}}
                </div>
            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        @foreach ($languages as $language)
            $("#table-{{ $language->lang }}").dataTable({
                "columnDefs": [{
                    "sortable": false,
                    "targets": [2, 3]
                }]
            });
        @endforeach
    </script>
@endpush
