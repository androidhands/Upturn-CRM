<?php
namespace App\Repositories\Admin\Office;

use App\Http\Requests\Admin\Office\StoreOfficeRequest;
use App\Http\Requests\Admin\Office\UpdateOfficeRequest;


interface OfficeRepositoryInterface{
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
   public function store(StoreOfficeRequest $request, string $companyId);

    /**
     * Display the specified resource.
     */
   public function show(string $companyId,string $officeId);
    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $companyId,string $officeId);

    /**
     * Update the specified resource in storage.
     */
   public function update(UpdateOfficeRequest $request,string $companyId, string $officeId);

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $companyId, string $officeId);
}