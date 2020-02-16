@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <channel-uploads :channel="{{ $channel }}" inline-template>

                <div class="col-md-8">
                    <div class="card p-3 d-flex justify-content-center align-items-center" v-if="!selected">
                        <svg onclick="document.getElementById('video-files').click()" xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             width="100" height="100" viewBox="0 0 24 24">
                            <path fill="crimson"
                                  d="M4,6H2V20A2,2 0 0,0 4,22H18V20H4V6M20,2H8A2,2 0 0,0 6,4V16A2,2 0 0,0 8,18H20A2,2 0 0,0 22,16V4A2,2 0 0,0 20,2M12,14.5V5.5L18,10L12,14.5Z">
                            </path>
                        </svg>
                        <input type="file" ref="videos" multiple id="video-files" class="d-none" accept="video/*"
                               @change="upload">
                        <p class="text-center">Upload Videos</p>
                    </div>
                    <div class="card p-3" v-else>
                        <div class="my-4" v-for="video in videos">
                            
                            <div class="progress mb-3">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" :style="{width: `${video.percentage || progress[video.name]}%`}">
                                    @{{ video.percentage ? video.percentage=== 100 ? 'Video Processing Completed' : 'Processing' : 'Uploading'}}
                                </div>
                            </div>

                            <div class="row">
                                
                                <div class="col-md-4">
                                    <div v-if="!video.thumbnail" class="d-flex justify-content-center align-items-center" style="height: 180px;color: #fff;font-size: 18px;background-color: #808080">
                                        Loading thumbnail
                                    </div>
                                    <img v-else :src="video.thumbnail" style="width: 100%" alt="">
                                </div>

                                <div class="col-md-4">
                                    <a v-if="video.percentage && video.percentage === 100" target="_blank" :href="`/videos/${video.id}`">
                                        @{{ video.title }}
                                    </a>
                                    <h4 v-else class="text-center">@{{ video.title || video.name }}</h4>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </channel-uploads>
        </div>
    </div>
@endsection
