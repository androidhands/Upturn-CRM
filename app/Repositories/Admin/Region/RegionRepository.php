<?php

namespace App\Repositories\Admin\Region;

use App\Http\Requests\Admin\Region\StoreRegionRequest;
use App\Http\Requests\Admin\Region\UpdateRegionRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\RegionResource;
use App\Models\Company;
use App\Models\Region;

class RegionRepository implements RegionRepositoryInterface
{

    /**
     * Display a listing of the resource.
     */
    public function index(string $companyId)
    {

        $query = Company::find($companyId)->regions();
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');
        if (request("id")) {
            $query->where("id", "like", request("id"));
        }

        if (request("name")) {
            $query->where("name", "like", "%" . request("name") . "%",);
        }

        $regions =  $query->orderBy($sortField, $sortDirection)->paginate(10);
        $company = Company::find($companyId);

        return  inertia('Admin/Region/Index', [
            "regions" => RegionResource::collection($regions),
            'queryParams' => request()->query() ?: null,
            'success' => session('success'),
            'company' => new CompanyResource($company)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $companyId)
    {
        $company = Company::find($companyId);
        return inertia("Admin/Region/Create", [
            'company' => new CompanyResource($company),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegionRequest $request, string $companyId)
    {
        $data = $request->validated();
        $company = Company::find($companyId);
        $region =   Region::create($data);
        $region->company()->associate($company);
        $region->save();
        return  to_route('region.index', $company)->with('success', 'Region created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $companyId, string $regionId)
    {
        $company = Company::find($companyId);
        $region = Region::find($regionId);
        return inertia("Admin/Region/Show", [
            "region" => new RegionResource($region),
            "company" => new CompanyResource($company)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $companyId, string $regionId)
    {
        $company = Company::find($companyId);
        $region = Region::find($regionId);
        return inertia('Admin/Region/Edit', [
            'region' => new RegionResource($region),
            'company' => new CompanyResource($company)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegionRequest $request, string $companyId, string $regionId)
    {
        $data = $request->validated();
        $company = Company::find($companyId);
        $region = Region::find($regionId);
        $region->update($data);
        return  to_route('region.index', $company)->with('success', "Region \"$region->name\" updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $companyId, string $regionId)
    {
        $company = Company::find($companyId);
        $region = Region::find($regionId);
        $name = $region->name;
        $region->delete();
        return to_route('region.index', $company)->with('success', "Region \"$name\" has been deleted successfully");
    }
}
