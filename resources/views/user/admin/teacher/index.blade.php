@extends('user.admin.master') @section('title')
    iCLOP | Dosen
@endsection
@section('content-header')
    <div class="content-header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p>Dosen</p>
                </div>
            </div>
        </div>
    </div>
    @endsection @section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <form action="{{ route('admin.teacher.add') }}" method="POST" id="form_tambah_data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Nama" name="name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select class="form-control" name="academic_year_id">
                                        <option value="" disabled selected>Tahun Ajaran</option>
                                        {{-- <option value="">2022</option> --}}
                                        @forelse ($year as $item)
                                                <option value="{{ $item->{'id'} }}">{{ $item->{'name'} }}
                                                </option>
                                            @empty
                                                <option value="" disabled>No Data
                                                </option>
                                            @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select class="form-control" name="user_id">
                                        <option value="" disabled selected hidden>User</option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">Tambah</button>
                    </form>
                </div>
                <div class="col-lg-8">
                    <table id="teacher_table" class="table table-hover table-head-fixed text-nowrap"
                            style="width: 100%">
                            <thead>
                                <th>Nama</th>
                                <th>Tahun Ajaran</th>
                                <th>Actions</th>

                            </thead>
                            <tbody></tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var datatable = $("#teacher_table").DataTable({
            processing: true,
            info: true,
            serverSide: true,
            ajax: "{{ route('admin.teacher.get') }}",
            columns: [
                {
                    data: "nama",
                    name: "nama",
                },
                {
                    data: "academic_year_id",
                    name: "academic_year_id",
                },
                {
                    data: "actions",
                    name: "actions",
                    searchable: false,
                    orderable: false,
                },

            ],
        });
        $("#form_tambah_data").on("submit", function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr("action"),
                method: $(form).attr("method"),
                data: new FormData(form),
                processData: false,
                dataType: "json",
                contentType: false,
                beforeSend: function() {
                    $(this).find("span.error-text").text("");
                },
                success: function(data) {
                    if (data.code == 0) {
                        $.each(data.error, function(prefix, val) {
                            $(form)
                                .find("span." + prefix + "_error")
                                .text(val[0]);
                        });
                    } else {
                        $(form)[0].reset();
                        datatable.ajax.reload(null, false);
                        alert(data.msg);
                        toastr.success(data.msg);
                    }
                },
            });
        });
    </script>
@endsection
