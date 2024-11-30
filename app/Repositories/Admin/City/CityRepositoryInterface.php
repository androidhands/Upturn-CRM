<?php
namespace App\Repositories\Admin\City;

use App\Http\Requests\Admin\City\StoreCityRequest;
use App\Http\Requests\Admin\City\UpdateCityRequest;


interface CityRepositoryInterface{
   /**
     * Display a listing of the resource.
     */
   public function index(string $countryId,string $governorateId);

    /**
     * Show the form for creating a new resource.
     */
   public function create(string $countryId,string $governorateId);

    /**
     * Store a newly created resource in storage.
     */
   public function store(StoreCityRequest $request,string $countryId, string $governorateId);

    /**
     * Display the specified resource.
     */
   public function show(string $countryId,string $governorateId,string $cityId);
    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $countryId,string $governorateId,string $cityId);

    /**
     * Update the specified resource in storage.
     */
   public function update(UpdateCityRequest $request,string $countryId,string $governorateId, string $cityId);

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $countryId,string $governorateId, string $cityId);
}