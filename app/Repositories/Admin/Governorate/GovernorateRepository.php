<?php

namespace App\Repositories\Admin\Governorate;

use App\Http\Requests\Admin\Governorate\StoreGovernorateRequest;
use App\Http\Requests\Admin\Governorate\UpdateGovernorateRequest;
use App\Http\Resources\CountryResource;
use App\Http\Resources\GovernorateResource;
use App\Models\Country;
use App\Models\Governorate;

class GovernorateRepository implements GovernorateRepositoryInterface
{

    /**
     * Display a listing of the resource.
     */
    public function index(string $countryId)
    {

        $query = Country::find($countryId)->governorates();
        $sortField = request('sort_field', 'id');
        $sortDirection = request( 'sort_direction', 'desc');
        if (request("id")) {
            $query->where("id", "like", request("id"));
        }

        if (request("name")) {
            $query->where("name", "like", "%" . request("name") . "%",);
        }

        $governorates =  $query->orderBy($sortField, $sortDirection)->paginate(10);
        $country = Country::find($countryId);

        return  inertia('Admin/Governorate/Index', [
            "governorates" => GovernorateResource::collection($governorates),
            'queryParams' => request()->query() ?: null,
            'success' => session('success'),
            'country' => new CountryResource($country)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $countryId)
    {
        $country = Country::find($countryId);
        return inertia("Admin/Governorate/Create", [
            'country' => new CountryResource($country),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGovernorateRequest $request, string $countryId)
    {
        $data = $request->validated();
        $country = Country::find($countryId);
        $governorate = Governorate::create($data);
        $governorate->country()->associate($country);
        $governorate->save();
        return to_route('governorate.index', parameters: $country)->with('success', 'Governorate created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $countryId, string $governorateId)
    {
        $country = Country::find($countryId);
        $governorate = Governorate::find( $governorateId);
        return inertia("Admin/Governorate/Show", props: [
            "governorate" => new GovernorateResource($governorate),
            "country" => new CountryResource($country)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $countryId, string $governorateId)
    {
        $country = Country::find($countryId);
        $governorate = Governorate::find($governorateId);
        return inertia('Admin/Governorate/Edit', [
            'governorate' => new GovernorateResource($governorate),
            'country' => new CountryResource($country)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGovernorateRequest $request, string $countryId, string $governorateId)
    {
        $data = $request->validated();
        $country = Country::find($countryId);
        $governorate = Governorate::find($governorateId);
        $governorate->update($data);
        return  to_route('governorate.index', $country)->with('success', "Governorate \"$governorate->name\" updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $countryId, string $governorateId)
    {
        $country = Country::find($countryId);
        $governorate = Governorate::find($governorateId);
        $name = $governorate->name;
        $governorate->delete();
        return to_route('governorate.index', $country)->with('success', "Governorate \"$name\" has been deleted successfully");
    }
}
