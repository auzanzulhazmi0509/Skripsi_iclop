@extends('user.student.master') @section('title')
    iCLOP | Soal
@endsection
@section('content-header')
    <div class="content-header">
        <div class="container">
            <div class="row">
                <header>
                    <h1>Soal</h1>
                </header>
            </div>
        </div>
    </div>
@endsection


@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                @forelse ($soal as $item)
                {{-- </div> --}}
                {{ $item->{'no'} . "."}}
                {{ $item->{'description'} . "."}}
                {{-- <div class="col-md-6"> --}}
                    <embed src="{{ asset('storage/dql_soal/' . $item->guide) }}" type="application/pdf" style="width: 100%; height: 500px;">
                    </div>
                    {{-- <div class="col-md-6">
                        <embed src="{{ Storage::disk('local')->url('/dql_soal/' . $item->guide) }}" type="application/pdf" style="width: 100%; height: 500px;">
                    </div> --}}
                    <div class="col-md-6">
                        <div class="editor" id="editor" style="height: 200px;" oncopy="return false" onpaste="return false" oncut="return false" ondrag="return false" ondrop="return false" contenteditable="false"></div>
                        <div class="row mt-3">
                            @if ($item->{'no'} <= 1)
                                <div class="col-3">
                                    <button class="btn btn-primary w-100" data-toggle="tooltip" data-placement="bottom"
                                        title="Sebelumnya" disabled><i class="fa fa-angle-left"></i></button>
                                </div>
                            @else
                                <div class="col-3">
                                    <button id="prevBtn" class="btn btn-primary w-100 data-toggle=" tooltip
                                        data-placement="bottom" title="Sebelumnya"
                                        onclick="window.location.href='/s/exercise-question/question/{{ $item->{'exercise_id'} }}/{{ $item->{'no'} - 1 }}'"><i
                                            class="fa fa-angle-left"></i></button>
                                </div>
                            @endif
                            @if ($item->{'no'} >= $jumlah_soal)
                                <div class="col-3">
                                    <button id="nextBtn" class="btn btn-primary w-100" data-toggle="tooltip"
                                        data-placement="bottom" title="Selanjutnya" disabled><i
                                            class="fa fa-angle-right"></i></button>
                                </div>
                            @else
                                <div class="col-3">
                                    <button class="btn btn-primary w-100" data-toggle="tooltip" data-placement="bottom"
                                        title="Selanjutnya"
                                        onclick="window.location.href='/s/exercise-question/question/{{ $item->{'exercise_id'} }}/{{ $item->{'no'} + 1 }}'">
                                        <i class="fa fa-angle-right"></i></button>
                                </div>
                            @endif
                            <div class="col-3">
                                <button id="runButton" class="btn btn-success w-100" data-toggle="tooltip"
                                data-placement="bottom" title="Run - Tombol ini akan menjalankan kode yang Anda tulis"><i class="fa fa-play"></i></button>
                            </div>
                            <div class="col-3">
                                <button id="submitButton" class="btn btn-warning w-100" data-toggle="tooltip"
                                data-placement="bottom" title="Submit - Tombol ini akan menyimpan jawaban Anda"><i class="fa-solid fa-check-to-slot"></i></button>
                            </div>

                        </div>
                        <div id="output" class="row mt-3"></div>
                    </div>
                @empty
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Tidak ada data pembelajaran!</h5>
                    </div>
                @endforelse
            </div>
        </div>

        <script src="{{ asset('editor/ide.js') }} "></script>
        <script src="{{ asset('editor/ace-editor/ace.js') }} "></script>
        <script src="{{ asset('editor/ace-editor/mode-pgsql.js') }} "></script>
        <script src="{{ asset('editor/ace-editor/theme-monokai.js') }} "></script>
        <script src="{{ asset('editor/ace-editor/ext-language_tools.js') }}"></script>
        <script>
            var langTools = ace.require("ace/ext/language_tools");
        </script>
    @endsection

    @section('script')
    <script>
        editor = ace.edit("editor");
        editor.setTheme("ace/theme/monokai");
        editor.session.setMode("ace/mode/pgsql");

        document.getElementById('editor').onkeydown = function(e) {
        if (e.ctrlKey === true && (e.key === 'c' || e.key === 'x' || e.key === 'v' || e.key === 'a')) {
            e.preventDefault();
            e.stopPropagation();
            return false;
        }
    };

    </script>

    <script>
        $('#runButton').click(function(){
            if (editor.getSession().getValue() == "") {
                alert("Silakan tulis jawaban anda terlebih dahulu!");
            } else {
                $.ajax({
                    url: "{{ route('student.runtest') }}",
                    method: "POST",
                    data: {
                        code: editor.getSession().getValue(),
                        question_id: "{{ $soal[0]->{'id'} }}",
                    },
                    success: function(response) {
                        // alert(editor.getSession().getValue());
                        $("#output").html(response.result);
                    },
                    error: function() {
                        $(".output").html("Something went wrong!");
                    }
                });
            }
        })
        $('#submitButton').click(function(){
            if (editor.getSession().getValue() == "") {
                alert("Silakan tulis jawaban anda terlebih dahulu!");
            } else {
                $.ajax({
                    url: "{{ route('student.submittest') }}",
                    method: "POST",
                    data: {
                        code: editor.getSession().getValue(),
                        question_id: "{{ $soal[0]->{'id'} }}",
                        user_id: "{{ Auth::user()->id }}",
                    },
                    success: function(response) {
                        $("#output").html(response.result);
                        if (response.status == 'passed') {
                                toastr.success(response.message);
                            } else {
                                toastr.warning(response.message);
                            }
                    },
                    error: function() {
                        $(".output").html("Something went wrong!");
                    }
                });
            }
        })

        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>
    @endsection

    