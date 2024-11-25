<?php
namespace App\Repositories\Admin\Company;

use App\Http\Requests\Admin\Company\StoreCompanyRequest;
use App\Http\Requests\Admin\Company\UpdateCompanyRequest;
use App\Models\Company;

interface CompanyRepositoryInterface{

    /**
     * Display a listing of the resource.
     */
   public function index();
   

    /**
     * Show the form for creating a new resource.
     */
   public function create();

    /**
     * Store a newly created resource in storage.
     */
   public function store(StoreCompanyRequest $request);
   

    /**
     * Display the specified resource.
     */
   public function show(Company $company);
   
    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Company $company);
    
    /**
     * Update the specified resource in storage.
     */
   public function update(UpdateCompanyRequest $request, Company $company);
   

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Company $company);
   


}