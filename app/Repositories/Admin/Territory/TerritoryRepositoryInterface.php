<?php
namespace App\Repositories\Admin\Territory;

use App\Http\Requests\Admin\Territory\StoreTerritoryRequest;
use App\Http\Requests\Admin\Territory\UpdateTerritoryRequest;


interface TerritoryRepositoryInterface{
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
   public function store(StoreTerritoryRequest $request, string $companyId);

    /**
     * Display the specified resource.
     */
   public function show(string $companyId,string $territoryId);
    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $companyId,string $territoryId);

    /**
     * Update the specified resource in storage.
     */
   public function update(UpdateTerritoryRequest $request,string $companyId, string $territoryId);

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $companyId, string $territoryId);
}