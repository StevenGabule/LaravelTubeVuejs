<?php

namespace App\Http\Controllers;

use App\Vote;
use App\Video;
use Illuminate\Http\Request;

class VoteController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function vote(Video $video, $type)
  {
      return auth()->user()->toggleVote($video, $type);
  }
}
