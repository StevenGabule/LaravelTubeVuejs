@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                @if ($video->editable())
            <form action="{{ route('videos.update', $video->id) }}" method="post">
                    @csrf
                    @method('PUT')
                @endif

                <div class="card-header">{{ $video->title}}</div>

                <div class="card-body">
                    <video-js id="video" class="vjs-default-skin" controls preload="auto" width="640" height="268">
                        <source src='{{ asset(Storage::url("videos/{$video->id}/{$video->id}.m3u8")) }}' type="application/x-mpegURL">
                    </video-js>

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mt-3">
                                @if ($video->editable())
                                    <input type="text" class="form-control" name="title" value="{{ $video->title}}">
                                @else
                                    {{ $video->title }}
                                @endif
                            </h4> 
                            {{ $video->views}} {{ str_plural('view', $video->views)}}
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M5,9V21H1V9H5M9,21A2,2 0 0,1 7,19V9C7,8.45 7.22,7.95 7.59,7.59L14.17,1L15.23,2.06C15.5,2.33 15.67,2.7 15.67,3.11L15.64,3.43L14.69,8H21C22.11,8 23,8.9 23,10V12C23,12.26 22.95,12.5 22.86,12.73L19.84,19.78C19.54,20.5 18.83,21 18,21H9M9,19H18.03L21,12V10H12.21L13.34,4.68L9,9.03V19Z" /></svg> 23k
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24"><path d="M19,15V3H23V15H19M15,3A2,2 0 0,1 17,5V15C17,15.55 16.78,16.05 16.41,16.41L9.83,23L8.77,21.94C8.5,21.67 8.33,21.3 8.33,20.88L8.36,20.57L9.31,16H3C1.89,16 1,15.1 1,14V12C1,11.74 1.05,11.5 1.14,11.27L4.16,4.22C4.46,3.5 5.17,3 6,3H15M15,5H5.97L3,12V14H11.78L10.65,19.32L15,14.97V5Z" /></svg> 11k
                        </div>
                    </div>
                    <div>
                        @if ($video->editable())
                            <textarea name="description" id="description" cols="3" rows="3" class="form-control">{{ $video->description }}</textarea>
                            <div class="text-right mt-3">
                                <button class="btn btn-info btn-sm" type="submit">Update video details</button>
                            </div>
                        @else
                            {{ $video->description }}
                        @endif
                    </div>
                    <hr>

                    <div class="d-flex justify-content-between align-items-center mt-5">
                        <div class="media">
                            <img src="https://picsum.photos/id/42/200/200" alt="" width="50" height="50" class="rounded-circle mr-3">
                            <div class="media-body ml-2">
                                <h5 class="mt-0 mb-0">{{ $video->channel->name}}</h5>
                            <span class="small">Published on {{ $video->created_at->toFormattedDateString() }}</span>
                            </div>
                        </div>
                        <subscribe-button :initial-subscriptions="{{ $video->channel->subscriptions }}" :channel="{{ $video->channel }}" />
                    </div>
                </div>
                @if ($video->editable())
                    </form>
                @endif
            </div><!-- end of card -->
        </div><!-- end of col-md-8 -->
    </div><!-- end of row -->
</div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.4.1/video-js.min.css">
    <style>
        .vjs-default-skin {
            width: 100%;
        }
    </style>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.4.1/video.min.js"></script>
<script>window.CURRENT_VIDEO  = '{{ $video->id }}'</script>
<script src="{{ asset('js/player.js') }}"></script>
@endsection
