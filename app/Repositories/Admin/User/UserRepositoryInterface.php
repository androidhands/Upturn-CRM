<?php
namespace App\Repositories\Admin\User;

use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\Company;
use App\Models\User;

interface UserRepositoryInterface{
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
   public function store(StoreUserRequest $request, Company $company);

    /**
     * Display the specified resource.
     */
   public function show(Company $company,User $user);
    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Company $company,User $user);

    /**
     * Update the specified resource in storage.
     */
   public function update(UpdateUserRequest $request,Company $company, User $user);

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Company $company, User $user);
}