<?php

namespace App\Repositories\Admin\Line;

use App\Http\Requests\Admin\Line\StoreLineRequest;
use App\Http\Requests\Admin\Line\UpdateLineRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\LineResource;
use App\Models\Company;
use App\Models\Line;

class LineRepository implements LineRepositoryInterface
{

    /**
     * Display a listing of the resource.
     */
    public function index(string $companyId)
    {

        $query = Company::find($companyId)->lines();
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');
        if (request("id")) {
            $query->where("id", "like", request("id"));
        }

        if (request("name")) {
            $query->where("name", "like", "%" . request("name") . "%",);
        }

        $lines =  $query->orderBy($sortField, $sortDirection)->paginate(10);
        $company = Company::find($companyId);

        return  inertia('Admin/Line/Index', [
            "lines" => LineResource::collection($lines),
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
        return inertia("Admin/Line/Create", [
            'company' => new CompanyResource($company),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLineRequest $request, string $companyId)
    {
        $data = $request->validated();
        $company = Company::find($companyId);
        $line = Line::create($data);
        $line->company()->associate($company);
        $line->save();
        return to_route('line.index', parameters: $company)->with('success', 'Line created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $companyId, string $lineId)
    {
        $company = Company::find($companyId);
        $line = Line::find($lineId);
        return inertia("Admin/Line/Show", [
            "line" => new LineResource($line),
            "company" => new CompanyResource($company)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $companyId, string $lineId)
    {
        $company = Company::find($companyId);
        $line = Line::find($lineId);
        return inertia('Admin/Line/Edit', [
            'line' => new LineResource($line),
            'company' => new CompanyResource($company)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLineRequest $request, string $companyId, string $lineId)
    {
        $data = $request->validated();
        $company = Company::find($companyId);
        $line = Line::find($lineId);
        $line->update($data);
        return  to_route('line.index', $company)->with('success', "Line \"$line->name\" updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $companyId, string $lineId)
    {
        $company = Company::find($companyId);
        $line = Line::find($lineId);
        $name = $line->name;
        $line->delete();
        return to_route('line.index', $company)->with('success', "Line \"$name\" has been deleted successfully");
    }
}
