<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Office\StoreOfficeRequest;
use App\Http\Requests\Admin\Office\UpdateOfficeRequest;


use App\Repositories\Admin\Office\OfficeRepositoryInterface;

class OfficeController extends Controller
{
    
    protected $officeRepositoryInterface;
    public function __construct(OfficeRepositoryInterface $officeRepositoryInterface){
        $this->officeRepositoryInterface = $officeRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(string $companyId)
    {
        return $this->officeRepositoryInterface->index($companyId);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $companyId)
    {
        return $this->officeRepositoryInterface->create($companyId); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfficeRequest $request,string $companyId)
    {
        return $this->officeRepositoryInterface->store($request, $companyId);   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $companyId,string $officeId)
    {
        return $this->officeRepositoryInterface->show($companyId, $officeId); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $companyId,string $officeId)
    {
        return $this->officeRepositoryInterface->edit($companyId, $officeId); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfficeRequest $request, string $companyId,string $officeId)
    {
        return  $this->officeRepositoryInterface->update($request, $companyId, $officeId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $companyId,string $officeId)
    {
        return $this->officeRepositoryInterface->destroy($companyId, $officeId);
    }
}
