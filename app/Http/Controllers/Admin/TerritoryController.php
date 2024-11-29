<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Territory\StoreTerritoryRequest;
use App\Http\Requests\Admin\Territory\UpdateTerritoryRequest;
use App\Models\Territory;
use App\Repositories\Admin\Territory\TerritoryRepositoryInterface;

class TerritoryController extends Controller
{
    protected $territoryRepositoryInterface;
    public function __construct(TerritoryRepositoryInterface $territoryRepositoryInterface){
        $this->territoryRepositoryInterface = $territoryRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(string $companyId)
    {
        return $this->territoryRepositoryInterface->index($companyId);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $companyId)
    {
        return $this->territoryRepositoryInterface->create($companyId); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTerritoryRequest $request,string $companyId)
    {
        return $this->territoryRepositoryInterface->store($request, $companyId);   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $companyId,string $territoryId)
    {
        return $this->territoryRepositoryInterface->show($companyId, $territoryId); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $companyId,string $territoryId)
    {
        return $this->territoryRepositoryInterface->edit($companyId, $territoryId); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTerritoryRequest $request, string $companyId,string $territoryId)
    {
        return  $this->territoryRepositoryInterface->update($request, $companyId, $territoryId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $companyId,string $territoryId)
    {
        return $this->territoryRepositoryInterface->destroy($companyId, $territoryId);
    }
}
