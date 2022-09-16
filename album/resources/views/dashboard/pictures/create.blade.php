@extends('layouts.parent')
@section('title', 'Create Picture')

@section('content')
    {{-- <div class="col-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div> --}}
    @include('includes.response-messages')
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create Picture</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{ route('picture.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-6">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="album_id">Album</label>
                            <select name="album_id" class='form-control @error('album_id') is-invalid @enderror' id="album_id">
                                <?php foreach($albums as $album) {?>
                                <option value="{{$album->id}}">{{$album->name}}</option>
                                <?php } ?>
                            </select>
                            @error('album_id')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3 col-12">
                        <label for="">Src</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('src') is-invalid @enderror"
                                id="customFile" name="src">
                            <label class="custom-file-label" for="customFile">Choose picture</label>
                            @error('src')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-primary" name="submit" value="index">Create Picture</button>
                </div>
            </form>
        </div>
    </div>
@endsection
