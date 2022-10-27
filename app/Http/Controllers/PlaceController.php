<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlaceRequest;
use App\Http\Resources\PlaceResource;
use App\Models\Place;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PlaceResource::collection(
            Place::where('user_id', Auth::user()->id)->get()
        )->groupBY('province');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return PlaceResource
     */
    public function store(StorePlaceRequest $request)
    {
        $request->validated($request->all());

        $place = Place::create(array_filter(
            [
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'is_favourite' => $request->is_favourite,
                'description' => $request->description,
                'image' => $request->image,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'province' => $request->province,
                'address' => $request->address,
                'distance' => $request->distance,
                'by_car' => $request->by_car,
                'by_public_transport' => $request->by_public_transport
            ]
        ));

        return new PlaceResource($place);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PlaceResource
     */
    public function show(Place $place)
    {
        if (Auth::user()->id !== $place->user_id){
            return $this->error('', 'Not Authorized!', 403);
        }

        return new PlaceResource($place);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
