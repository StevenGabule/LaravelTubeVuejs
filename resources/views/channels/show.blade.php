@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">
                        {{ $channel->name}}
                    </div>

                    <div class="card-body">
                        <form action="{{ route('channels.update', $channel->id) }}" method="post"
                              enctype="multipart/form-data" id="update-channel-form">
                            @csrf
                            @method('PATCH')

                            <div class="form-group row justify-content-center">
                                <div class="channel-avatar">
                                    <div class="channel-avatar-overlay" onclick="document.getElementById('image').click()">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" fill="white" version="1.1"
                                             width="48" height="48" viewBox="0 0 24 24">
                                            <path
                                                d="M4,4H7L9,2H15L17,4H20A2,2 0 0,1 22,6V18A2,2 0 0,1 20,20H4A2,2 0 0,1 2,18V6A2,2 0 0,1 4,4M12,7A5,5 0 0,0 7,12A5,5 0 0,0 12,17A5,5 0 0,0 17,12A5,5 0 0,0 12,7M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9Z"></path>
                                        </svg>
                                    </div>
                                    <img src="{{ $channel->image() }}" alt="">

                                </div>
                            </div>

                            <input type="file" name="image" id="image" accept="image/*" class="d-none" onchange="document.getElementById('update-channel-form').submit()">

                            <div class="form-group">
                                <label for="name" class="form-control-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                       value="{{ $channel->name }}">
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-control-label">Description</label>
                                <textarea name="description" id="description" class="form-control"
                                          rows="10">{{ $channel->description }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-info">Update Channel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
