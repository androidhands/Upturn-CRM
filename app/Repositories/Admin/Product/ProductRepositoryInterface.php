<?php
namespace App\Repositories\Admin\Product;

use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Company;
use App\Models\Product;


interface ProductRepositoryInterface{
   public function index(Company $company);
   public function create(Company $company);
   public function store(StoreProductRequest $request,Company $company);
   public function show(Company $company,Product $product);
   public function edit(Company $company,Product $product);
   public function update(UpdateProductRequest $request,Company $company, Product $product);
   public function destroy(Company $company,Product $product);


}