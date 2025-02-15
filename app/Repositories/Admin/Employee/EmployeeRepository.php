<?php

namespace App\Repositories\Admin\Employee;

use App\Http\Requests\Admin\Employee\StoreEmployeeRequest;
use App\Http\Requests\Admin\Employee\UpdateEmployeeRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserResource;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;

class EmployeeRepository implements EmployeeRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function create(string $companyId, string $userId)
    {
        $company = Company::find($companyId);
        $user = User::find($userId);
        $roles = $company->roles;
        return inertia("Admin/Employee/Create", [
            "company" => new CompanyResource($company),
            "user" => new UserResource($user),
            "roles" => RoleResource::collection($roles)
        ]);
    }

    /**
     * @inheritDoc
     */
    public function destroy(string $companyId, string $userId, string $employeeId) {}

    /**
     * @inheritDoc
     */
    public function edit(string $companyId, string $userId)
    {
        $company = Company::find($companyId);
        $user = User::find($userId);
        $company->load('roles');
        $user->load('employee');
        return inertia("Admin/Employee/Edit", [
            "company" => new CompanyResource($company),
            "user" => new UserResource($user),

        ]);
    }

    /**
     * @inheritDoc
     */
    public function index(string $companyId, string $userId) {}

    /**
     * @inheritDoc
     */
    public function show(string $companyId, string $userId, string $employeeId) {}

    /**
     * @inheritDoc
     */
    public function store(StoreEmployeeRequest $request, string $companyId, string $userId)
    {
        $data = $request->validated();
        $user = User::find($userId);
        $company = Company::find($companyId);
        $employee = Employee::create($data);
        $user->employee()->save($employee);
        $employee->save();
        $employee->load('role');
        return inertia("Admin/User/Show", [
            "company" => new CompanyResource($company),
            "user" => new UserResource($user),
            "employee" => new EmployeeResource($employee)

        ])->with('success', 'Employee created successfully');
    }

    /**
     * @inheritDoc
     */
    public function update(UpdateEmployeeRequest $request, string $companyId, string $userId)
    {
        $data = $request->validated();
        $company = Company::find($companyId);
        $company->load('roles');
        $user = User::find($userId);
        $employee = Employee::find($user->employee->id);
        $employee->update($data);
        $employee->load('role');
        return inertia("Admin/User/Show", [
            "company" => new CompanyResource($company),
            "user" => new UserResource($user),
            "employee" => new EmployeeResource($employee)

        ])->with('success', "Employee \"$user->name\" updated successfully");
    }
}
