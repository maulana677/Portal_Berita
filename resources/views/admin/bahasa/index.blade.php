@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Language') }}</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('All Languages') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.bahasa.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('Create New') }}
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>{{ __('Nama Bahasa') }}</th>
                                <th>{{ __('Kode Bahasa') }}</th>
                                <th>{{ __('Default') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bahasa as $bahasa)
                                <tr>
                                    <td>
                                        {{ $bahasa->id }}
                                    </td>
                                    <td>{{ $bahasa->name }}</td>
                                    <td>{{ $bahasa->lang }}</td>
                                    <td>
                                        @if ($bahasa->default == 1)
                                            <span class="badge badge-primary">{{ __('Default') }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ __('Tidak') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($bahasa->status == 1)
                                            <span class="badge badge-success">{{ __('Aktif') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __('Non Aktif') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.bahasa.edit', $bahasa->id) }}" class="btn btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                        <a href="{{ route('admin.bahasa.destroy', $bahasa->id) }}"
                                            class="btn btn-danger delete-item"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $("#table-1").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [2, 3]
            }]
        });
    </script>
@endpush
