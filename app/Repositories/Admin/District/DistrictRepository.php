<?php

namespace App\Repositories\Admin\District;

use App\Http\Requests\Admin\District\StoreDistrictRequest;
use App\Http\Requests\Admin\District\UpdateDistrictRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\DistrictResource;
use App\Models\Company;
use App\Models\District;

class DistrictRepository implements DistrictRepositoryInterface
{

    /**
     * Display a listing of the resource.
     */
    public function index(string $companyId)
    {

        $query = Company::find($companyId)->districts();
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');
        if (request("id")) {
            $query->where("id", "like", request("id"));
        }

        if (request("name")) {
            $query->where("name", "like", "%" . request("name") . "%",);
        }

        $districts =  $query->orderBy($sortField, $sortDirection)->paginate(10);
        $company = Company::find($companyId);

        return  inertia('Admin/District/Index', [
            "districts" => DistrictResource::collection($districts),
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
        return inertia("Admin/District/Create", [
            'company' => new CompanyResource($company),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDistrictRequest $request, string $companyId)
    {
        $data = $request->validated();
        $company = Company::find($companyId);
        $district =   District::create($data);
        $district->company()->associate($company);
        $district->save();
        return  to_route('district.index', $company)->with('success', 'District created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $companyId, string $districtId)
    {
        $company = Company::find($companyId);
        $district = District::find($districtId);
        return inertia("Admin/District/Show", [
            "district" => new DistrictResource($district),
            "company" => new CompanyResource($company)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $companyId, string $districtId)
    {
        $company = Company::find($companyId);
        $district = District::find($districtId);
        return inertia('Admin/District/Edit', [
            'district' => new DistrictResource($district),
            'company' => new CompanyResource($company)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDistrictRequest $request, string $companyId, string $districtId)
    {
        $data = $request->validated();
        $password = $data['password'] ?? null;
        if ($password) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $company = Company::find($companyId);
        $district = District::find($districtId);
        $district->update($data);
        return  to_route('district.index', $company)->with('success', "District \"$district->name\" updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $companyId, string $districtId)
    {
        $company = Company::find($companyId);
        $district = District::find($districtId);
        $name = $district->name;
        $district->delete();
        return to_route('district.index', $company)->with('success', "District \"$name\" has been deleted successfully");
    }
}
