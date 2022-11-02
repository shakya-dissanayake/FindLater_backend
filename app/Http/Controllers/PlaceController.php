<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlaceRequest;
use App\Http\Resources\PlaceResource;
use App\Models\Place;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
        $data = $this->getValues($request->coordinatesO, $request->coordinates);

        $place = Place::create(array_filter(
            [
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'is_favourite' => $request->is_favourite,
                'description' => $request->description,
                'image' => $request->image,
                'coordinates' => $request->coordinates,
                'province' => $this->getProvince($request->coordinates),
                'address' => $request->address,
                'distance' => $data[0],
                'by_car' => $data[1],
                'by_public_transport' => $data[2]
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
        if (Auth::user()->id !== $place->user_id) {
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

    protected function getProvince($coordinates)
    {
        $response = Http::withOptions(['verify' => false])
            ->withHeaders(['Authorization' => 'prj_test_sk_f5eb01e5d699467b8f00a91d0fc4e991e75212a3'])
            ->get('https://api.radar.io/v1/geocode/reverse', ['coordinates' => $coordinates]);

        $state = json_decode($response->body())->addresses[0]->state;
        $states = collect([
            'Ampara' => 'Eastern Province',
            'Anuradhapura' => 'North Central Province',
            'Badulla' => 'Uva Province',
            'Batticaloa' => 'Eastern Province',
            'Colombo' => 'Western Province',
            'Galle' => 'Southern Province',
            'Gampaha' => 'Western Province',
            'Hambantota' => 'Southern Province',
            'Jaffna' => 'Northern Province',
            'Kalutara' => 'Western Province',
            'Kandy' => 'Central Province',
            'Kegalle' => 'Sabaragamuwa Province',
            'Kilinochchi' => 'Northern Province',
            'Kurunegala' => 'North Western Province',
            'Mannar' => 'Northern Province',
            'Matale' => 'Central Province',
            'Matara' => 'Southern Province',
            'Monaragala' => 'Uva Province',
            'Mullaitivu' => 'Northern Province',
            'Nuwara Eliya' => 'Central Province',
            'Polonnaruwa' => 'North Central Province',
            'Puttalam' => 'North Western Province',
            'Ratnapura' => 'Sabaragamuwa Province',
            'Trincomalee' => 'Eastern Province',
            'Vavuniya' => 'Northern Province',
        ]);
        return $states[$state];
    }

    protected function getValues($coordinatesO, $coordinates)
    {
        $response = Http::withOptions(['verify' => false])
            ->withHeaders(['Authorization' => 'prj_test_sk_f5eb01e5d699467b8f00a91d0fc4e991e75212a3'])
            ->get('https://api.radar.io/v1/route/distance', [
                'origin' => $coordinatesO,
                'destination' => $coordinates,
                'modes' => 'car,bike',
                'units' => 'metric'
            ]);

        if (json_decode($response->body())->meta->code == 400) {
            $response = Http::withOptions(['verify' => false])
                ->withHeaders(['Authorization' => 'prj_test_sk_f5eb01e5d699467b8f00a91d0fc4e991e75212a3'])
                ->get('https://api.radar.io/v1/route/distance', [
                    'origin' => $coordinatesO,
                    'destination' => $coordinates,
                    'modes' => 'car',
                    'units' => 'metric'
                ]);

            if (json_decode($response->body())->meta->code == 400) {
                $response = Http::withOptions(['verify' => false])
                    ->withHeaders(['Authorization' => 'prj_test_sk_f5eb01e5d699467b8f00a91d0fc4e991e75212a3'])
                    ->get('https://api.radar.io/v1/route/distance', [
                        'origin' => $coordinatesO,
                        'destination' => $coordinates,
                        'units' => 'metric'
                    ]);

                if (json_decode($response->body())->meta->code == 400) {
                    $response = Http::withOptions(['verify' => false])
                        ->withHeaders(['Authorization' => 'prj_test_sk_f5eb01e5d699467b8f00a91d0fc4e991e75212a3'])
                        ->get('https://api.radar.io/v1/route/distance', [
                            'origin' => $coordinatesO,
                            'destination' => $coordinates,
                            'units' => 'metric'
                        ]);
                    if (json_decode($response->body())->meta->code == 400) {
                        $response = Http::withOptions(['verify' => false])
                            ->withHeaders(['Authorization' => 'prj_test_sk_f5eb01e5d699467b8f00a91d0fc4e991e75212a3'])
                            ->get('https://api.radar.io/v1/route/distance', [
                                'origin' => $coordinatesO,
                                'destination' => $coordinates,
                                'units' => 'metric'
                            ]);
                        return ['N/A', 'N/A', 'N/A'];
                    } else {
                        return [json_decode($response->body())->routes->geodesic->distance->text,
                            'N/A', 'N/A'];
                    }
                } else {
                    return [json_decode($response->body())->routes->car->distance->text,
                        'N/A', 'N/A'];
                }
            } else {
                return [json_decode($response->body())->routes->car->distance->text,
                    json_decode($response->body())->routes->car->duration->text,
                    'N/A'];
            }
        } else {
            return [json_decode($response->body())->routes->car->distance->text,
                json_decode($response->body())->routes->car->duration->text,
                json_decode($response->body())->routes->bike->duration->text];
        }
    }
}
