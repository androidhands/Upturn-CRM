<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use App\Http\Requests\Admin\Region\StoreRegionRequest;
use App\Http\Requests\Admin\Region\UpdateRegionRequest;
use App\Repositories\Admin\Region\RegionRepositoryInterface;

class RegionController extends Controller
{
    protected $regionRepositoryInterface;
    public function __construct(RegionRepositoryInterface $regionRepositoryInterface)
    {
        $this->regionRepositoryInterface = $regionRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(string $companyId)
    {
        return $this->regionRepositoryInterface->index($companyId);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $companyId)
    {
        return $this->regionRepositoryInterface->create($companyId);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegionRequest $request, string $companyId)
    {
        return $this->regionRepositoryInterface->store($request, $companyId);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $companyId, string $regionId)
    {
        return $this->regionRepositoryInterface->show($companyId, $regionId);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $companyId, string $regionId)
    {
        return $this->regionRepositoryInterface->edit($companyId, $regionId);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegionRequest $request, string $companyId, string $regionId)
    {
        return $this->regionRepositoryInterface->update($request, $companyId, $regionId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $companyId, string $regionId)
    {
        return $this->regionRepositoryInterface->destroy($companyId, $regionId);
    }
}
