@extends('user.teacher.master')
@section('title')
@section('content')
    <div class="content">
        <button onclick="goBack()" class="btn btn-secondary">Kembali</button>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table id="tabel_nilai" class="table table-hover table-head-fixed text-nowrap" style="width: 100%">
                        <thead>
                            <tr>
                                {{-- <th>No</th> --}}
                                <th>Soal</th>
                                <th>Tanggal Submit</th>
                                <th>Tanggal Update</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('user.student.result.detail-nilai-latihan-modal')
@endsection

@section('script')
    <script>
        function goBack() {
            window.history.back();
        }
        $(document).ready(function () {
            var table = $('#tabel_nilai').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('student.result.getResultByExerciseTable', ['student_id' => $student_id]) }}",
                columns: [
                    // {
                    //     data: 'no',
                    //     name: 'no'
                    // },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $(document).on('click', '#jawaban', function () {
                var submission_id = $(this).data('id');
                var url = '{{ route("teacher.result.getSubmissionDetail") }}';
                $.get(url, { submission_id: submission_id }, function (data) {
                    var modal = $('.answerModal');
                    $(modal).find('h4').text(data.details[0].soal['title']);
                    $(modal).find('code').text(data.details[0].answer);
                    $(modal).modal('show');
                }, "json");
            });
        });
    </script>
@endsection
