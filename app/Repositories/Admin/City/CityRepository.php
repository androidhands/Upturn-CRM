<?php

namespace App\Repositories\Admin\City;

use App\Http\Requests\Admin\City\StoreCityRequest;
use App\Http\Requests\Admin\City\UpdateCityRequest;
use App\Http\Resources\CountryResource;
use App\Http\Resources\GovernorateResource;
use App\Http\Resources\CityResource;
use App\Models\Governorate;
use App\Models\City;
use App\Models\Country;

class CityRepository implements CityRepositoryInterface
{

    /**
     * Display a listing of the resource.
     */
    public function index(string $countryId,string $governorateId)
    {
          $country = Country::find($countryId);
        $governorate = Governorate::find($governorateId);
        $query = $governorate ->cities();
        $sortField = request('sort_field', 'id');
        $sortDirection = request( 'sort_direction', 'desc');
        if (request("id")) {
            $query->where("id", "like", request("id"));
        }

        if (request("name")) {
            $query->where("name", "like", "%" . request("name") . "%",);
        }

        $cities =  $query->orderBy($sortField, $sortDirection)->paginate(10);
       
        return  inertia('Admin/City/Index', [
            "cities" => CityResource::collection($cities),
            'queryParams' => request()->query() ?: null,
            'success' => session('success'),
            'country'=>new CountryResource( $country),
            'governorate' => new GovernorateResource($governorate)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $countryId,string $governorateId)
    {

        $governorate = Governorate::find($governorateId);
        $country = Country::find($countryId);
        return inertia("Admin/City/Create", [
            'country'=>new CountryResource($country),   
            'governorate' => new GovernorateResource($governorate),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCityRequest $request,string $countryId, string $governorateId)
    {
        $data = $request->validated();
        $governorate = Governorate::find($governorateId);
        $city = City::create($data);
        $city->governorate()->associate($governorate);
        $city->save();
        $country = Country::find($countryId);
        return to_route('city.index', parameters: [$country,$governorate])->with('success', 'City created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $countryId,string $governorateId, string $cityId)
    {
        $governorate = Governorate::find($governorateId);
        $city = City::find($cityId);
        $country = Country::find($countryId);
        return inertia("Admin/City/Show", [
            "city" => new CityResource($city),
            "governorate" => new GovernorateResource($governorate),
            'country'=>new CountryResource($country),   
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $countryId,string $governorateId, string $cityId)
    {
        $governorate = Governorate::find($governorateId);
        $country = Country::find($countryId);
        $city = City::find($cityId);
        return inertia('Admin/City/Edit', [
            'city' => new CityResource($city),
            'governorate' => new GovernorateResource($governorate),
            'country'=>new CountryResource($country),   
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCityRequest $request, string $countryId,string $governorateId, string $cityId)
    {
        $data = $request->validated();
        $governorate = Governorate::find($governorateId);
        $city = City::find($cityId);
        $city->update($data);
        $country = Country::find($countryId);
        return  to_route('city.index', [$country,$governorate])->with('success', "City \"$city->name\" updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $countryId, string $governorateId, string $cityId)
    {
      
        $governorate = Governorate::find($governorateId);
        $city = City::find($cityId);
        $name = $city->name;
        $city->delete();
        $country = Country::find($countryId);
        return to_route('city.index', [$country,$governorate])->with('success', "City \"$name\" has been deleted successfully");
    }
}
