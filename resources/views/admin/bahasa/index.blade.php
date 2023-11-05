@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('admin.Language') }}</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('admin.All Languages') }}</h4>
                <div class="card-header-action">
                    <a href="{{ route('admin.bahasa.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('admin.Create New') }}
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
                                <th>{{ __('admin.Language') }}</th>
                                <th>{{ __('admin.Code') }}</th>
                                <th>{{ __('admin.Default') }}</th>
                                <th>{{ __('admin.Status') }}</th>
                                <th>{{ __('admin.Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bahasa as $bahasa)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>{{ $bahasa->name }}</td>
                                    <td>{{ $bahasa->lang }}</td>
                                    <td>
                                        @if ($bahasa->default == 1)
                                            <span class="badge badge-primary">{{ __('admin.Default') }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ __('admin.No') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($bahasa->status == 1)
                                            <span class="badge badge-success">{{ __('admin.Active') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __('admin.Non Active') }}</span>
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
