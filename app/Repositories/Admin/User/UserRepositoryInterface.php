<?php

namespace App\Repositories\Admin\User;

use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\Company;
use App\Models\User;

interface UserRepositoryInterface
{
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
  public function store(StoreUserRequest $request, string $companyId);

  /**
   * Display the specified resource.
   */
  public function show(string $companyId, string $userId);
  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $companyId, string $userId);

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateUserRequest $request, string $companyId, string $userId);

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $companyId, string $userId);
}
