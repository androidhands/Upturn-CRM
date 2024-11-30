<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Line\StoreLineRequest;
use App\Http\Requests\Admin\Line\UpdateLineRequest;


use App\Repositories\Admin\Line\LineRepositoryInterface;

class LineController extends Controller
{
    
    protected $lineRepositoryInterface;
    public function __construct(LineRepositoryInterface $lineRepositoryInterface){
        $this->lineRepositoryInterface = $lineRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(string $companyId)
    {
        return $this->lineRepositoryInterface->index($companyId);    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $companyId)
    {
        return $this->lineRepositoryInterface->create($companyId); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLineRequest $request,string $companyId)
    {
        return $this->lineRepositoryInterface->store($request, $companyId);   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $companyId,string $lineId)
    {
        return $this->lineRepositoryInterface->show($companyId, $lineId); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $companyId,string $lineId)
    {
        return $this->lineRepositoryInterface->edit($companyId, $lineId); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLineRequest $request, string $companyId,string $lineId)
    {
        return  $this->lineRepositoryInterface->update($request, $companyId, $lineId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $companyId,string $lineId)
    {
        return $this->lineRepositoryInterface->destroy($companyId, $lineId);
    }
}
