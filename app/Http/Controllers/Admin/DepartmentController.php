<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Department\StoreDepartmentRequest;
use App\Http\Requests\Admin\Department\UpdateDepartmentRequest;
use App\Repositories\Admin\Department\DepartmentRepositoryInterface;

class DepartmentController extends Controller
{

    protected $departmentRepositoryInterface;
    public function __construct(DepartmentRepositoryInterface $departmentRepositoryInterface){
        $this->departmentRepositoryInterface = $departmentRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(string $companyId)
    {
        return $this->departmentRepositoryInterface->index($companyId);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $companyId)
    {
        return $this->departmentRepositoryInterface->create($companyId);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request,string $companyId)
    {
        return $this->departmentRepositoryInterface->store($request, $companyId);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $companyId,string $departmentId)
    {
        return $this->departmentRepositoryInterface->show($companyId, $departmentId);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $companyId,string $departmentId)
    {
        return $this->departmentRepositoryInterface->edit($companyId, $departmentId);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request,string $companyId, string $departmentId)
    {
        return $this->departmentRepositoryInterface->update($request, $companyId, $departmentId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $companyId, string $departmentId)
    {
        return $this->departmentRepositoryInterface->destroy($companyId, $departmentId);
    }
}
