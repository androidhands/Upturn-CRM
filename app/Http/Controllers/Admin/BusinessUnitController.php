<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BusinessUnit\StoreBusinessUnitRequest;
use App\Http\Requests\Admin\BusinessUnit\UpdateBusinessUnitRequest;
use App\Repositories\Admin\BusinessUnit\BusinessUnitRepositoryInterface;

class BusinessUnitController extends Controller
{

    protected $businessUnitRepositoryInterface;
    public function __construct(BusinessUnitRepositoryInterface $businessUnitRepositoryInterface){
        $this->businessUnitRepositoryInterface = $businessUnitRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(string $companyId)
    {
        return $this->businessUnitRepositoryInterface->index($companyId);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $companyId)
    {
        return $this->businessUnitRepositoryInterface->create($companyId);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBusinessUnitRequest $request,string $companyId)
    {
        return $this->businessUnitRepositoryInterface->store($request, $companyId);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $companyId,string $businessUnitId)
    {
        return $this->businessUnitRepositoryInterface->show($companyId, $businessUnitId);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $companyId,string $businessUnitId)
    {
        return $this->businessUnitRepositoryInterface->edit($companyId, $businessUnitId);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBusinessUnitRequest $request,string $companyId, string $businessUnitId)
    {
        return $this->businessUnitRepositoryInterface->update($request, $companyId, $businessUnitId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $companyId, string $businessUnitId)
    {
        return $this->businessUnitRepositoryInterface->destroy($companyId, $businessUnitId);
    }
}
