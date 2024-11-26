<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\Company;
use App\Models\User;
use App\Repositories\Admin\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepositoryInterface;
    public function __construct(UserRepositoryInterface $userRepositoryInterface){
        $this->userRepositoryInterface = $userRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Company $company)
    {
        return $this->userRepositoryInterface->index($company);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company)
    {
        return $this->userRepositoryInterface->create($company);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request, Company $company)
    {
        return $this->userRepositoryInterface->store($request,$company);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company,User $user)
    {
        return $this->userRepositoryInterface->show($company,$user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company,User $user)
    {
        return $this->userRepositoryInterface->edit($company,$user); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request,Company $company, User  $user)
    {
        return $this->userRepositoryInterface->update($request,$company, $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company, User $user)
    {
        return $this->userRepositoryInterface->destroy($company,$user);  
    }
}
