@extends('layouts.parent')
@section('title', 'view album')


@section('content')

@include('includes.response-messages')
<div class="col-12">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">view album</h3>
        </div>
        {{-- <input type="hidden" name="id" value="{{ $album->id }}"> --}}
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                        value="{{ $album->name }}">
                    @error('name')
                    <p class="text-danger"> {{ $message }} </p>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="created_at">Created_at</label>
                    <input type="created_at" name="created_at"
                        class="form-control @error('created_at') is-invalid @enderror" id="created_at"
                        value="{{ $album->created_at }}">
                    @error('created_at')
                    <p class="text-danger"> {{ $message }} </p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="p-3"><a href="{{ route('picture.create') }}" class="btn btn-outline-primary"> Add
                            Picture To Album </a></div>
                </div>
                <div class="col-4">
<?php if(sizeof($pictures)!= 0){ ?>
                    <div class="p-3">
                        <a class="btn btn-outline-warning" href="{{ route('album.transport', $album->id) }}"> Transport photos and Delete
                            Album </a>
                    </div>
<?php } ?>
                </div>
                <div class="col-4">
                    <div class="p-3">
                        <form action="{{ route('album.destroy', $album->id) }}" class="d-inline" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-outline-danger"> Delete Album with Photos</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>


        <!-- /.card-header -->

        <div class="card-header">
            <h3 class="card-title">album's picture</h3>
        </div>
        <table id="example1" class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Src</th>
                    <th>Creation Date</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pictures as $picture)
                <tr>
                    <td>{{ $picture->id }}</td>
                    <td>{{ $picture->name }}</td>
                    <td>
                        <img src="{{url('/images/pictures/'.$picture->src)}}" alt="{{$picture->name}}" class="w-25 h-25"
                            style="cursor: pointer">
                    </td>
                    <td>{{ $picture->created_at }}</td>
                    <td>

                        <a href="{{ route('picture.edit', $picture->id) }}" class="btn btn-outline-warning"> Edit </a>
                        <form action="{{ route('picture.destroy', $picture->id) }}" class="d-inline" method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-outline-danger"> Delete </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
