<?php
namespace App\Repositories\Admin\District;

use App\Http\Requests\Admin\District\StoreDistrictRequest;
use App\Http\Requests\Admin\District\UpdateDistrictRequest;
use App\Models\Company;
use App\Models\District;

interface DistrictRepositoryInterface{
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
   public function store(StoreDistrictRequest $request, string $companyId);

    /**
     * Display the specified resource.
     */
   public function show(string $companyId,string $districtId);
    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $companyId,string $districtId);

    /**
     * Update the specified resource in storage.
     */
   public function update(UpdateDistrictRequest $request,string $companyId, string $districtId);

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $companyId, string $districtId);
}