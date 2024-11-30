<?php

namespace App\Repositories\Admin\Office;

use App\Http\Requests\Admin\Office\StoreOfficeRequest;
use App\Http\Requests\Admin\Office\UpdateOfficeRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\OfficeResource;
use App\Models\Company;
use App\Models\Office;

class OfficeRepository implements OfficeRepositoryInterface
{

    /**
     * Display a listing of the resource.
     */
    public function index(string $companyId)
    {

        $query = Company::find($companyId)->offices();
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');
        if (request("id")) {
            $query->where("id", "like", request("id"));
        }

        if (request("name")) {
            $query->where("name", "like", "%" . request("name") . "%",);
        }

        $offices =  $query->orderBy($sortField, $sortDirection)->paginate(10);
        $company = Company::find($companyId);

        return  inertia('Admin/Office/Index', [
            "offices" => OfficeResource::collection($offices),
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
        return inertia("Admin/Office/Create", [
            'company' => new CompanyResource($company),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfficeRequest $request, string $companyId)
    {
        $data = $request->validated();
        $company = Company::find($companyId);
        $office = Office::create($data);
        $office->company()->associate($company);
        $office->save();
        return to_route('office.index', parameters: $company)->with('success', 'Office created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $companyId, string $officeId)
    {
        $company = Company::find($companyId);
        $office = Office::find($officeId);
        return inertia("Admin/Office/Show", [
            "office" => new OfficeResource($office),
            "company" => new CompanyResource($company)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $companyId, string $officeId)
    {
        $company = Company::find($companyId);
        $office = Office::find($officeId);
        return inertia('Admin/Office/Edit', [
            'office' => new OfficeResource($office),
            'company' => new CompanyResource($company)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfficeRequest $request, string $companyId, string $officeId)
    {
        $data = $request->validated();
        $company = Company::find($companyId);
        $office = Office::find($officeId);
        $office->update($data);
        return  to_route('office.index', $company)->with('success', "Office \"$office->name\" updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $companyId, string $officeId)
    {
        $company = Company::find($companyId);
        $office = Office::find($officeId);
        $name = $office->name;
        $office->delete();
        return to_route('office.index', $company)->with('success', "Office \"$name\" has been deleted successfully");
    }
}
