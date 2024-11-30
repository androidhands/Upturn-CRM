<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Governorate\StoreGovernorateRequest;
use App\Http\Requests\Admin\Governorate\UpdateGovernorateRequest;


use App\Repositories\Admin\Governorate\GovernorateRepositoryInterface;

class GovernorateController extends Controller
{
    
    protected $governorateRepositoryInterface;
    public function __construct(GovernorateRepositoryInterface $governorateRepositoryInterface){
        $this->governorateRepositoryInterface = $governorateRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(string $countryId)
    {
        return $this->governorateRepositoryInterface->index($countryId);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $countryId)
    {
        return $this->governorateRepositoryInterface->create($countryId); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGovernorateRequest $request,string $countryId)
    {
        return $this->governorateRepositoryInterface->store($request, $countryId);   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $countryId,string $governorateId)
    {
        return $this->governorateRepositoryInterface->show($countryId, $governorateId); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $countryId,string $governorateId)
    {
        return $this->governorateRepositoryInterface->edit($countryId, $governorateId); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGovernorateRequest $request, string $countryId,string $governorateId)
    {
        return  $this->governorateRepositoryInterface->update($request, $countryId, $governorateId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $countryId,string $governorateId)
    {
        return $this->governorateRepositoryInterface->destroy($countryId, $governorateId);
    }
}
