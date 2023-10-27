@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ __('Pending News') }}</h1>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h4>{{ __('All Pending') }}</h4>
            </div>

            @php
                if (canAccess(['news all-access'])) {
                    $news = \App\Models\News::with('category')
                        ->where('is_approved', 0)
                        ->orderBy('id', 'ASC')
                        ->get();
                } else {
                    $news = \App\Models\News::with('category')
                        ->where('is_approved', 0)
                        ->where(
                            'auther_id',
                            auth()
                                ->guard('admin')
                                ->user()->id,
                        )
                        ->orderBy('id', 'ASC')
                        ->get();
                }
            @endphp
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>{{ __('Gambar') }}</th>
                                <th>{{ __('Judul') }}</th>
                                <th>{{ __('Kategori') }}</th>
                                <th>{{ __('Approve') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $item)
                                <tr>
                                    <td>{{ ++$loop->index }}</td>
                                    <td>
                                        <img src="{{ asset($item->image) }}" width="100" alt="">
                                    </td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>
                                        <form action="" id="approve_form">
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <div class="form-group">
                                                <select name="is_approved" class="form-control" id="approve_input">
                                                    <option value="0">{{ __('Pending') }}</option>
                                                    <option value="1">{{ __('Approved') }}</option>
                                                </select>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-primary"><i
                                                class="fas fa-edit"></i></a>
                                        <a href="{{ route('admin.berita.destroy', $item->id) }}"
                                            class="btn btn-danger delete-item"><i class="fas fa-trash-alt"></i></a>
                                        <a href="{{ route('admin.berita-copy', $item->id) }}" class="btn btn-primary"><i
                                                class="fas fa-copy"></i></a>
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
        $("#table").dataTable({
            "columnDefs": [{
                "sortable": false,
                "targets": [2, 3]
            }],
            "order": [
                [0, 'desc']
            ]
        });

        $(document).ready(function() {

            $('#approve_input').on('change', function() {
                $('#approve_form').submit();
            });

            $('#approve_form').on('submit', function(e) {
                e.preventDefault();

                let data = $(this).serialize();
                $.ajax({
                    method: 'PUT',
                    url: "{{ route('admin.approve.news') }}",
                    data: data,
                    success: function(data) {
                        if (data.status === 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            })

                            window.location.reload();
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
