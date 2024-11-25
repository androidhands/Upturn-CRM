<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Company\StoreCompanyRequest;
use App\Http\Requests\Admin\Company\UpdateCompanyRequest;
use App\Models\Company;
use App\Repositories\Admin\Company\CompanyRepositoryInterface;

class CompanyController extends Controller
{
    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository){
        $this->companyRepository = $companyRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->companyRepository->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->companyRepository->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        return $this->companyRepository->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return $this->companyRepository->show($company);    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return $this->companyRepository->edit($company);
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        return $this->companyRepository->update($request, $company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        return $this->companyRepository->destroy($company);
    }
}
