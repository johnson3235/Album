@extends('layouts.parent')
@section('title', 'delete album')


@section('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('content')
@include('includes.response-messages')
<div class="col-12">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Edit album</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="{{ route('album.dotransport',$album->id) }}" enctype="multipart/form-data">
            
            @csrf
            @method('POST')
            <input type="hidden" name="id" value="{{ $album->id }}">

            <div class="card-body">
                <div class="form-row">
                    <div class="col-6">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            id="name" value="{{ $album->name }}" disabled>
                        @error('name')
                        <p class="text-danger"> {{ $message }} </p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="new_id">Album</label>
                        <select name="new_id" class='form-control @error(' new_id') is-invalid @enderror'
                            id="new_id">
                            <?php foreach($newalbums as $newalbum) {
                                     if ($newalbum->id != $album->id)
                                    {?>
                            <option value="{{$newalbum->id}}">{{$newalbum->name}}</option>
                            <?php }} ?>
                        </select>
                        @error('new_id')
                        <p class="text-danger"> {{ $message }} </p>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-outline-warning" name="submit" value="index">Transport and Delete Album</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
    <!-- DataTables  & Plugins -->
    <script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ url('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ url('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>


@endsection