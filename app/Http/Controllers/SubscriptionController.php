<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Channel $channel)
    {
        return $channel->subscriptions()->create([
            'user_id' => auth()->id()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Channel $channel
     * @param \App\Subscription $subscription
     * @return void
     */
    public function destroy(Channel $channel, Subscription $subscription)
    {
        if ($subscription->delete()) {
            return response()->json([
                'message' => true
            ]);
        }
        return response()->json(['error' => true]);
    }
}
