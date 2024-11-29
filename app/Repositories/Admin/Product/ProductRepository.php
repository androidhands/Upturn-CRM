<?php
namespace App\Repositories\Admin\Product;

use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\ProductResource;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductRepository implements ProductRepositoryInterface{
   
   /**
    * @inheritDoc
    */
   public function create(Company $company) {
      return inertia("Admin/Product/Create",[
        'company'=>new CompanyResource($company)
      ]);
   }
   
   /**
    * @inheritDoc
    */
   public function destroy(Company $company,Product $product) {
      $name = $product->name;
      $product->delete();
      if($product->flagUrl){
          Storage::disk('public')->deleteDirectory(dirname($product->flagUrl));
      }
      return to_route('product.index',$company)->with('success', "Product \"$name\" has been deleted successfully");

   }
   
   /**
    * @inheritDoc
    */
   public function edit(Company $company,Product $product) {
      return inertia("Admin/Product/Edit", [
         'product'=> new ProductResource(resource: $product),
         'baseUrl' => request()->getSchemeAndHttpHost(),
         'company'=>new CompanyResource($company)
     ]);
   }
   
   /**
    * @inheritDoc
    */
   public function index(Company $company) {
      
      $query = $company->products();
      $sortField = request('sort_field', 'created_at');
      $sortDirection = request('sort_direction', 'asc');
     if(request("id")){
          $query->where("id", "like", request("id"));
     }

      if(request("name")){
          $query->where("name", "like", "%" . request("name") . "%", );
      }
     
     $countires =  $query->orderBy($sortField,$sortDirection)->paginate(10);
      return inertia('Admin/Product/Index', [
          'products'=> ProductResource::collection($countires),
          'queryParams' => request()->query() ?: null,
          'success'=>session('success'),
         'baseUrl' => request()->getSchemeAndHttpHost(),
         'company'=>new CompanyResource($company)
      ]);
   }
   
   /**
    * @inheritDoc
    */
   public function show(Company $company,Product $product) {
      return inertia('Admin/Product/Show', [
         'product'=>new ProductResource($product),
        'baseUrl' => request()->getSchemeAndHttpHost(),
        'company'=>new CompanyResource($company)
        
     ]);
   }
   
   /**
    * @inheritDoc
    */
   public function store(StoreProductRequest $request,Company $company) {
      $data = $request->validated();
      /** * @var $image \Illuminate\Http\UploadededFile*/
      $image = $data['imageUrl'] ?? null;
      if($image){
          $path = $image->store('Product/' . Str::random(), 'public');
          $data['imageUrl'] =   $path;
      }
     $product =  Product::create($data);
      $product->company()->associate($company);
      $product->save(); 
    return  to_route('product.index',$company)->with('success','Product created successfully');
   }
   
   /**
    * @inheritDoc
    */
   public function update(UpdateProductRequest $request,Company $company, Product $product) {
      
      $data = $request->validated();
      /** * @var $image \Illuminate\Http\UploadededFile*/
      $image = $data['imageUrl'] ?? null;
     
      if($image){
          if($product->imageUrl){
              Storage::disk('public')->deleteDirectory(dirname($product->imageUrl));
          }
          $data['imageUrl'] = $image->store('Product/' . Str::random(), 'public');
      }else{
          $data['imageUrl'] = $product->imageUrl;
      }

      $product->update($data);
    return  to_route('product.index',$company)->with('success',"Product \"$product->name\" updated successfully");
   }
}