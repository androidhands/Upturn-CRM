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
    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(string $companyId)
    {
        return $this->userRepositoryInterface->index($companyId);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $companyId)
    {
        return $this->userRepositoryInterface->create($companyId);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request, string $companyId)
    {
        return $this->userRepositoryInterface->store($request, $companyId);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $companyId, string $userId)
    {  
        return $this->userRepositoryInterface->show($companyId, $userId);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $companyId, string $userId)
    {
        return $this->userRepositoryInterface->edit($companyId, $userId);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $companyId, string  $userId)
    {
        return $this->userRepositoryInterface->update($request, $companyId, $userId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $companyId, string $userId)
    {
        return $this->userRepositoryInterface->destroy($companyId, $userId);
    }
}
