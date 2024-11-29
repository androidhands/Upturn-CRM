<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Models\Company;
use App\Models\Role;
use App\Repositories\Admin\Role\RoleRepositoryInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleRepositoryInterface;
    public function __construct(RoleRepositoryInterface $roleRepositoryInterface){
        $this->roleRepositoryInterface = $roleRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Company $company)
    {
        return $this->roleRepositoryInterface->index($company);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company)
    {
        return $this->roleRepositoryInterface->create($company);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request,Company $company)
    {
        return $this->roleRepositoryInterface->store($request, $company);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company,Role $role)
    {
        return $this->roleRepositoryInterface->show($company, $role);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company,Role $role)
    {
        return $this->roleRepositoryInterface->edit($company, $role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request,Company $company, Role $role)
    {
        return $this->roleRepositoryInterface->update($request, $company, $role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company,Role $role)
    {
        return $this->roleRepositoryInterface->destroy($company, $role);
    }
}
