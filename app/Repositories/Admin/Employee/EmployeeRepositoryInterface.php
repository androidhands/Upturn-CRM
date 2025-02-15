<?php

namespace App\Repositories\Admin\Employee;

use App\Http\Requests\Admin\Employee\StoreEmployeeRequest;
use App\Http\Requests\Admin\Employee\UpdateEmployeeRequest;

interface EmployeeRepositoryInterface
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $companyId, string $userId);


    /**
     * Show the form for creating a new resource.
     */
    public function create(string $companyId, string $userId);

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request, string $companyId, string $userId);


    /**
     * Display the specified resource.
     */
    public function show(string $companyId, string $userId, string $employeeId);


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $companyId, string $userId);

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, string $companyId, string $userId);


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $companyId, string $userId, string $employeeId);
}
