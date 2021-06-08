@extends('layouts.admin1')

@section('content')
    <div class="container">
        <h1>Ad Manager</h1>
        <hr>
        @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif
        <p>
            This is where you can manage the content of the advertisment slideshow that is displayed on the homepage.
        </p>
        <div class="row">
            <div class="col-3">
                <form class="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.admanager.store') }}">
                    <div class="form-group">
                        <label for="ad_photo">Upload new Ad</label>
                        <input type="file" class="form-control" name="ad_photo" id="ad_photo" accept="image/png, image/jpeg">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    @csrf
                </form>
            </div>
            <div class="col">
                <div class="container">
                    @foreach($ads as $ad)
                    <a type="button" data-bs-toggle="modal" data-bs-target="#control-{{$ad->id}}">
                        <img src="/{{$ad->filename}}" class="img-thumbnail" alt="{{$ad->id}}" width="200">
                    </a>
                @endforeach
            </div>
                </div>
        </div>

    </div>

    @foreach($ads as $ad)
    <div class="modal fade" tabindex="-1" id="control-{{$ad->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ad {{$ad->id}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        &#10005;
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-4">
                                <a href="{{route('admin.admanager.delete', $ad->id)}}" class="btn btn-danger">
                                    Delete
                                </a>
                            </div>
                            <div class="col-8">
                                <img src="/{{$ad->filename}}" class="img-thumbnail">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach


@endsection
