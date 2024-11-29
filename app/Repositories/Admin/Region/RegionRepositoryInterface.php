<?php
namespace App\Repositories\Admin\Region;

use App\Http\Requests\Admin\Region\StoreRegionRequest;
use App\Http\Requests\Admin\Region\UpdateRegionRequest;
use App\Models\Company;
use App\Models\Region;

interface RegionRepositoryInterface{
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
   public function store(StoreRegionRequest $request, string $companyId);

    /**
     * Display the specified resource.
     */
   public function show(string $companyId,string $regionId);
    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $companyId,string $regionId);

    /**
     * Update the specified resource in storage.
     */
   public function update(UpdateRegionRequest $request,string $companyId, string $regionId);

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $companyId, string $regionId);
}