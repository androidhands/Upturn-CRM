<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\City\StoreCityRequest;
use App\Http\Requests\Admin\City\UpdateCityRequest;


use App\Repositories\Admin\City\CityRepositoryInterface;

class CityController extends Controller
{
    
    protected $cityRepositoryInterface;
    public function __construct(CityRepositoryInterface $cityRepositoryInterface){
        $this->cityRepositoryInterface = $cityRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(string $countryId, string $governorateId)
    {
        return $this->cityRepositoryInterface->index($countryId,$governorateId);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $countryId,string $governorateId)
    {
        return $this->cityRepositoryInterface->create($countryId, $governorateId); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCityRequest $request,string $countryId,string $governorateId)
    {
        return $this->cityRepositoryInterface->store($request,$countryId,  $governorateId);   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $governorateId,string $countryId,string $cityId)
    {
        return $this->cityRepositoryInterface->show($governorateId,$countryId, $cityId); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $governorateId,string $countryId,string $cityId)
    {
        return $this->cityRepositoryInterface->edit( $governorateId,$countryId, $cityId); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCityRequest $request,string $countryId, string $governorateId,string $cityId)
    {
        return  $this->cityRepositoryInterface->update($request,$countryId,  $governorateId, $cityId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $countryId,string $governorateId,string $cityId)
    {
        return $this->cityRepositoryInterface->destroy( $countryId, $governorateId, $cityId);
    }
}
