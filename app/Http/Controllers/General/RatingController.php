<?php

namespace SavyCon\Http\Controllers\General;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use SavyCon\Models\UserService;
use SavyCon\Models\UserServiceRating;

use SavyCon\Jobs\Mails\User\NotifyUserOnNewServiceReview;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware('auth:api');

        $this->validate($request, [
            'stars' => 'required|integer',
            'comment' => 'required',
        ]);

        $rating = new UserServiceRating();
        $rating->user_id = auth('api')->user()->id;
        $rating->user_service_id = $request->service_id;
        $rating->stars = $request->stars;
        $rating->comment = $request->comment;
        $rating->save();

        NotifyUserOnNewServiceReview::dispatch($rating)->delay(now()->addSeconds(15));

        return response([
            'rating' => $rating,
            'msg' => 'ok'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ratings = UserService::findOrFail($id)->ratings()->with([
            'user',
        ])->latest()->paginate(5);

        return response($ratings, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
