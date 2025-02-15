<?php
namespace App\Repositories\Admin\Department;

use App\Http\Requests\Admin\Department\StoreDepartmentRequest;
use App\Http\Requests\Admin\Department\UpdateDepartmentRequest;
use App\Models\Company;


interface DepartmentRepositoryInterface{
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
   public function store(StoreDepartmentRequest $request, string $companyId);

    /**
     * Display the specified resource.
     */
   public function show(string $companyId,string $departmentId);
    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $companyId,string $departmentId);

    /**
     * Update the specified resource in storage.
     */
   public function update(UpdateDepartmentRequest $request,string $companyId, string $departmentId);

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(string $companyId, string $departmentId);
}
