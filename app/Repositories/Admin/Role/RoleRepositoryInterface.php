<?php
namespace App\Repositories\Admin\Role;

use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Models\Company;
use App\Models\Role;

interface RoleRepositoryInterface{
   /**
     * Display a listing of the resource.
     */
   public function index(Company $company);

    /**
     * Show the form for creating a new resource.
     */
   public function create(Company $company);

    /**
     * Store a newly created resource in storage.
     */
   public function store(StoreRoleRequest $request, Company $company);

    /**
     * Display the specified resource.
     */
   public function show(Company $company,Role $role);
    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Company $company,Role $role);

    /**
     * Update the specified resource in storage.
     */
   public function update(UpdateRoleRequest $request,Company $company, Role $role);

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Company $company, Role $role);
}