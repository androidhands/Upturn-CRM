<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\District\StoreDistrictRequest;
use App\Http\Requests\Admin\District\UpdateDistrictRequest;
use App\Models\District;
use App\Repositories\Admin\District\DistrictRepositoryInterface;

class DistrictController extends Controller
{
    protected $districtRepositoryInterface;
    public function __construct(DistrictRepositoryInterface $districtRepositoryInterface)
    {
        $this->districtRepositoryInterface = $districtRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(string $companyId)
    {
        return $this->districtRepositoryInterface->index($companyId);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $companyId)
    {
        return $this->districtRepositoryInterface->create($companyId);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDistrictRequest $request, string $companyId)
    {
        return $this->districtRepositoryInterface->store($request, $companyId);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $companyId, string $districtId)
    {
        return $this->districtRepositoryInterface->show($companyId, $districtId);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $companyId, string $districtId)
    {
        return $this->districtRepositoryInterface->edit($companyId, $districtId);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDistrictRequest $request, string $companyId, string $districtId)
    {
        return $this->districtRepositoryInterface->update($request, $companyId, $districtId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $companyId, string $districtId)
    {
        return $this->districtRepositoryInterface->destroy($companyId, $districtId);
    }
}
