<?php
namespace App\Repositories\Admin\Line;

use App\Http\Requests\Admin\Line\StoreLineRequest;
use App\Http\Requests\Admin\Line\UpdateLineRequest;


interface LineRepositoryInterface{
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
   public function store(StoreLineRequest $request, string $companyId);

    /**
     * Display the specified resource.
     */
   public function show(string $companyId,string $lineId);
    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $companyId,string $lineId);

    /**
     * Update the specified resource in storage.
     */
   public function update(UpdateLineRequest $request,string $companyId, string $lineId);

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $companyId, string $lineId);
}