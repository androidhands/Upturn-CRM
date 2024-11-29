<?php
namespace App\Repositories\Admin\BusinessUnit;

use App\Http\Requests\Admin\BusinessUnit\StoreBusinessUnitRequest;
use App\Http\Requests\Admin\BusinessUnit\UpdateBusinessUnitRequest;
use App\Models\Company;
use App\Models\BusinessUnit;

interface BusinessUnitRepositoryInterface{
   /**
     * Display a listing of the resource.
     */
   public function index(string $companyId);

    /**
     * Show the form for creating a new resource.
     */
   public function create(string $companyId);

    /**
     * Store a newly created resource in storage.
     */
   public function store(StoreBusinessUnitRequest $request, string $companyId);

    /**
     * Display the specified resource.
     */
   public function show(string $companyId,string $businessUnitId);
    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $companyId,string $businessUnitId);

    /**
     * Update the specified resource in storage.
     */
   public function update(UpdateBusinessUnitRequest $request,string $companyId, string $businessUnitId);

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $companyId, string $businessUnitId);
}