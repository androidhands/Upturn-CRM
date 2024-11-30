<?php
namespace App\Repositories\Admin\Governorate;

use App\Http\Requests\Admin\Governorate\StoreGovernorateRequest;
use App\Http\Requests\Admin\Governorate\UpdateGovernorateRequest;


interface GovernorateRepositoryInterface{
   /**
     * Display a listing of the resource.
     */
   public function index(string $countryId);

    /**
     * Show the form for creating a new resource.
     */
   public function create(string $countryId);

    /**
     * Store a newly created resource in storage.
     */
   public function store(StoreGovernorateRequest $request, string $countryId);

    /**
     * Display the specified resource.
     */
   public function show(string $countryId,string $governorateId);
    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $countryId,string $governorateId);

    /**
     * Update the specified resource in storage.
     */
   public function update(UpdateGovernorateRequest $request,string $countryId, string $governorateId);

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $countryId, string $governorateId);
}