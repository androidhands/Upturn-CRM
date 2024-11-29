<?php

namespace App\Repositories\Admin\Territory;

use App\Http\Requests\Admin\Territory\StoreTerritoryRequest;
use App\Http\Requests\Admin\Territory\UpdateTerritoryRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\TerritoryResource;
use App\Models\Company;
use App\Models\Territory;

class TerritoryRepository implements TerritoryRepositoryInterface
{

    /**
     * Display a listing of the resource.
     */
    public function index(string $companyId)
    {

        $query = Company::find($companyId)->territories();
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');
        if (request("id")) {
            $query->where("id", "like", request("id"));
        }

        if (request("name")) {
            $query->where("name", "like", "%" . request("name") . "%",);
        }

        $territories =  $query->orderBy($sortField, $sortDirection)->paginate(10);
        $company = Company::find($companyId);

        return  inertia('Admin/Territory/Index', [
            "territories" => TerritoryResource::collection($territories),
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
        return inertia("Admin/Territory/Create", [
            'company' => new CompanyResource($company),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTerritoryRequest $request, string $companyId)
    {
        $data = $request->validated();
        $company = Company::find($companyId);
        $territory = Territory::create($data);
        $territory->company()->associate($company);
        $territory->save();
        return to_route('territory.index', parameters: $company)->with('success', 'Territory created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $companyId, string $territoryId)
    {
        $company = Company::find($companyId);
        $territory = Territory::find($territoryId);
        return inertia("Admin/Territory/Show", [
            "territory" => new TerritoryResource($territory),
            "company" => new CompanyResource($company)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $companyId, string $territoryId)
    {
        $company = Company::find($companyId);
        $territory = Territory::find($territoryId);
        return inertia('Admin/Territory/Edit', [
            'territory' => new TerritoryResource($territory),
            'company' => new CompanyResource($company)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTerritoryRequest $request, string $companyId, string $territoryId)
    {
        $data = $request->validated();
        $company = Company::find($companyId);
        $territory = Territory::find($territoryId);
        $territory->update($data);
        return  to_route('territory.index', $company)->with('success', "Territory \"$territory->name\" updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $companyId, string $territoryId)
    {
        $company = Company::find($companyId);
        $territory = Territory::find($territoryId);
        $name = $territory->name;
        $territory->delete();
        return to_route('territory.index', $company)->with('success', "Territory \"$name\" has been deleted successfully");
    }
}
