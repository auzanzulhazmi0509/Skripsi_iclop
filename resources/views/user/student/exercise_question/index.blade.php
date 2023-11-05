@extends('user.student.master')
@section('title')
    iCLOP | Daftar Soal
@endsection
@section('content-header')
    <div class="content-header">
        {{-- <div class="container"> --}}
            <div class="row">
                <div class="col">
                    <b>Daftar Soal</b>
                </div>
            </div>
        {{-- </div> --}}
    </div>
@endsection

@section('content')
    <div class="content">
        <div class="content">
            {{-- <div class="container">
                <div class="row">
                    <div class="col-md-12"> --}}
                    <div class="table-responsive">
                        <table id="tabel_soal" class="table table-hover table-head-fixed text-nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                <th>No</th>
                                <th>Soal</th>
                                <th>Topik</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    {{-- </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#tabel_soal').DataTable({
            processing: true,
            info: true,
            serverSide: true,
            ajax: "{{ route('student.exerciseQuestion.questionList', ['exercise_id' => $exercise_id])  }}",
            columns: [{
                    data: "no",
                    name: "no"
                },
                {
                    data: "title",
                    name: "title"
                },
                {
                    data: "topic",
                    name: "topic"
                },
                {
                    data: "description",
                    name: "description"
                },
                {
                    data: "status",
                    name: "status",
                    render: function(data, type, full, meta) {
                        if (data === "dikerjakan") {
                            return '<span class="badge badge-success">Selesai</span>';
                        } else {
                            return '<span class="badge badge-warning">Belum Dikerjakan</span>';
                        }
                    }
                },
                {
                    data: "actions",
                    name: "actions"
                },
            ]
        });
    </script>
@endsection
