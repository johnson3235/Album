@extends('layouts.parent')
@section('title', 'Edit picture')

@section('content')

    @include('includes.response-messages')
    <div class="col-12">
        <div class="card card-warning">
            <div class="card-header">
                <h3 class="card-title">Edit picture</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{ route('picture.updates',$picture->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- <input type="hidden" name="id" value="{{ $picture->id }}"> --}}
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-6">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                id="name_en" value="{{ $picture->name }}">
                            @error('name')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="album_id">Album</label>
                            <select name="album_id" class='form-control @error('album_id') is-invalid @enderror' id="album_id">
                                <?php foreach($albums as $album) {?>
                                <option <?php if($picture->album_id == $album->id){echo 'selected';}?> value="{{$album->id}}">{{$album->name}}</option>
                                <?php } ?>
                            </select>
                            @error('album_id')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6">
                            <label for="customFile">Image <br><img src="{{url('/images/pictures/'.$picture->src)}}" alt="{{$picture->name}}" class="w-50 " style="cursor: pointer"></label>
                            <input type="file" class="d-none" id="customFile" name="src">
                            @error('src')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-warning" name="submit" value="index">Update picture</button>
                </div>
            </form>
        </div>
    </div>
               <!-- <td><img src="{{url('/images/pictures/'.$picture->src)}}" alt="{{$picture->name}}" class="w-50 " style="cursor: pointer"></td> -->
@endsection

