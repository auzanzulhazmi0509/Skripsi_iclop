@extends('user.admin.master')

@section('title')
    iCLOP | Update Dosen
@endsection

@section('content-header')
    <div class="content-header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p>Update Dosen</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('admin.teacher.update', ['id' => $teacher->id]) }}" method="POST" id="form_update_data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Nama" name="name" value="{{ $teacher->nama }}">
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
                                                <option value="{{ $item->{'id'} }}" {{ $teacher->academic_year_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->{'name'} }}
                                                </option>
                                            @empty
                                                <option value="" disabled>No Data</option>
                                            @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <select class="form-control" name="user_id">
                                        <option value="" disabled selected hidden>User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $teacher->user_id == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">Update</button>
                        <a href="javascript:history.back()" class="btn btn-block btn-secondary">Close</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Your script here for update functionality
    </script>
@endsection
