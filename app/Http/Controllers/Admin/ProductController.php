<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Company;
use App\Models\Product;
use App\Repositories\Admin\Product\ProductRepositoryInterface;

class ProductController extends Controller
{
    protected $productRepositoryInterface;
    public function __construct(ProductRepositoryInterface $productRepositoryInterface){
        $this->productRepositoryInterface = $productRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Company $company)
    {
        return $this->productRepositoryInterface->index($company);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company)
    {
        return $this->productRepositoryInterface->create($company);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request,Company $company)
    {
        return $this->productRepositoryInterface->store($request, $company);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company,Product $product)
    {
        return $this->productRepositoryInterface->show($company, $product); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company,Product $product)
    {
        return $this->productRepositoryInterface->edit($company, $product); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request,Company $company, Product $product)
    {
        return $this->productRepositoryInterface->update($request,$company, $product);   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company,Product $product)
    {
        return $this->productRepositoryInterface->destroy($company, $product);  
    }
}
