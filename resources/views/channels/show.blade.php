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
                        @if($channel->editable())
                            <form action="{{ route('channels.update', $channel->id) }}" method="post"
                                  enctype="multipart/form-data" id="update-channel-form">
                                @csrf
                                @method('PATCH')
                                @endif

                                <div class="form-group row justify-content-center">
                                    <div class="channel-avatar">
                                        @auth
                                            <div class="channel-avatar-overlay"
                                                 onclick="document.getElementById('image').click()">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" fill="white"
                                                     version="1.1"
                                                     width="48" height="48" viewBox="0 0 24 24">
                                                    <path
                                                        d="M4,4H7L9,2H15L17,4H20A2,2 0 0,1 22,6V18A2,2 0 0,1 20,20H4A2,2 0 0,1 2,18V6A2,2 0 0,1 4,4M12,7A5,5 0 0,0 7,12A5,5 0 0,0 12,17A5,5 0 0,0 17,12A5,5 0 0,0 12,7M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9Z"></path>
                                                </svg>
                                            </div>
                                        @endauth
                                        <img src="{{ $channel->image() }}" alt="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h4 class="text-center">
                                        {{ $channel->name }}
                                    </h4>
                                    <p class="text-center text-capitalize">
                                        {{ $channel->description }}
                                    </p>
                                    <div class="text-center">
                                        <button class="btn btn-danger">Subscribe</button>
                                    </div>
                                </div>

                                @if($channel->editable())
                                    <input type="file" name="image" id="image" accept="image/*" class="d-none"
                                           onchange="document.getElementById('update-channel-form').submit()">

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

                                    @if($errors->any())
                                        <ul class="list-group mt-3 mb-3">
                                            @foreach($errors->all() as $error)
                                                <li class="list-group-item text-danger">
                                                    {{ $error }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    <button type="submit" class="btn btn-info">Update Channel</button>
                                @endif
                                @if($channel->editable())
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
