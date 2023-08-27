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
                    <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
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
                    @foreach ($languages as $language)
                        @php
                            $news = \App\Models\News::with('category')
                                ->where('language', $language->lang)
                                ->orderBy('id', 'DESC')
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
                                                <th>{{ __('Gambar') }}</th>
                                                <th>{{ __('Judul') }}</th>
                                                <th>{{ __('Kategori') }}</th>
                                                <th>{{ __('In Breaking') }}</th>
                                                <th>{{ __('In Slider') }}</th>
                                                <th>{{ __('In Popular') }}</th>
                                                <th>{{ __('Status') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($news as $item)
                                                <tr>
                                                    <td>{{ $item->id }}</td>
                                                    <td>
                                                        <img src="{{ asset($item->image) }}" width="100" alt="">
                                                    </td>
                                                    <td>{{ $item->title }}</td>
                                                    <td>{{ $item->category->name }}</td>

                                                    <td>
                                                        <label class="custom-switch mt-2">
                                                            <input {{ $item->is_breaking_news === 1 ? 'checked' : '' }}
                                                                data-id={{ $item->id }} data-name="is_breaking_news"
                                                                value="1" type="checkbox"
                                                                class="custom-switch-input toggle-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <label class="custom-switch mt-2">
                                                            <input {{ $item->show_at_slider === 1 ? 'checked' : '' }}
                                                                data-id={{ $item->id }} data-name="show_at_slider"
                                                                value="1" type="checkbox"
                                                                class="custom-switch-input toggle-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <label class="custom-switch mt-2">
                                                            <input {{ $item->show_at_popular === 1 ? 'checked' : '' }}
                                                                data-id={{ $item->id }} data-name="show_at_popular"
                                                                value="1" type="checkbox"
                                                                class="custom-switch-input toggle-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <label class="custom-switch mt-2">
                                                            <input {{ $item->status === 1 ? 'checked' : '' }}
                                                                data-id={{ $item->id }} data-name="status"
                                                                value="1" type="checkbox"
                                                                class="custom-switch-input toggle-status">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('admin.kategori.edit', $item->id) }}"
                                                            class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                                        <a href="{{ route('admin.kategori.destroy', $item->id) }}"
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
                    @endforeach
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
                }],
                "order": [
                    [0, 'desc']
                ]
            });
        @endforeach

        $(document).ready(function() {
            $('.toggle-status').on('click', function() {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let status = $(this).prop('checked') ? 1 : 0;

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.toggle-berita-status') }}",
                    data: {
                        id: id,
                        name: name,
                        status: status
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            })
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
