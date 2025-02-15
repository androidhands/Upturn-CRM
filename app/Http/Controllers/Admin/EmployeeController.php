<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Employee\StoreEmployeeRequest;
use App\Http\Requests\Admin\Employee\UpdateEmployeeRequest;
use App\Repositories\Admin\Employee\EmployeeRepositoryInterface;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employeeRepsitoryInterface;
    public function __construct(EmployeeRepositoryInterface $employeeRepsitoryInterface)
    {
        $this->employeeRepsitoryInterface = $employeeRepsitoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(string $companyId, string $userId): void
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $companyId, string $userId)
    {
        return $this->employeeRepsitoryInterface->create($companyId, $userId);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request, string $companyId, string $userId)
    {

        return $this->employeeRepsitoryInterface->store($request, $companyId, $userId);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $companyId, string $userId, string $employeeId)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $companyId, string $userId)
    {
        return $this->employeeRepsitoryInterface->edit($companyId, $userId);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, string $companyId, string $userId)
    {
        return $this->employeeRepsitoryInterface->update($request, $companyId, $userId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $companyId, string $userId, string $employeeId)
    {
        //
    }
}
