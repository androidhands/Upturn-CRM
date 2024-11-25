<?php
namespace App\Repositories\Admin\Company;

use App\Http\Requests\Admin\Company\StoreCompanyRequest;
use App\Http\Requests\Admin\Company\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CountryResource;
use App\Models\Company;
use App\Models\Country;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class CompanyRepository implements CompanyRepositoryInterface{
   
   /**
    * @inheritDoc
    */
   public function create() {
      $countries = Country::query()->get();
      return inertia("Admin/Company/Create",[
         'countries'=> CountryResource::collection($countries),
         
      ]);
   }
   
   /**
    * @inheritDoc
    */
   public function destroy(Company $company) {
      $name = $company->name;
      $company->delete();
      if($company->logoUrl){
          Storage::disk('public')->deleteDirectory(dirname($company->logoUrl));
      }
      return to_route('company.index')->with('success', "Company \"$name\" has been deleted successfully");
   }
   
   /**
    * @inheritDoc
    */
   public function edit(Company $company) {
      // Load the countries relationship
      $countries = Country::query()->get();
      $company->load('countries');
      return inertia("Admin/Company/Edit", [
         'company'=> new CompanyResource(resource: $company),
         'baseUrl' => request()->getSchemeAndHttpHost(),
         'countries'=> CountryResource::collection($countries),
     ]);
   }
   
   /**
    * @inheritDoc
    */
   public function index() {
      $query = Company::query();
      $sortField = request('sort_field', 'created_at');
      $sortDirection = request('sort_direction', 'asc');
     if(request("id")){
          $query->where("id", "like", request("id"));
     }

      if(request("name")){
          $query->where("name", "like", "%" . request("name") . "%", );
      }
     
     $companies =  $query->orderBy($sortField,$sortDirection)->paginate(10);
      return inertia('Admin/Company/Index', [
          'companies'=> CompanyResource::collection($companies),
          'queryParams' => request()->query() ?: null,
          'success'=>session('success'),
         'baseUrl' => request()->getSchemeAndHttpHost()
      ]);
   }
   
   /**
    * @inheritDoc
    */
   public function show(Company $company) {
      $company->load('countries');
      return inertia('Admin/Company/Show', [
         'company'=>new CompanyResource($company),
        'baseUrl' => request()->getSchemeAndHttpHost(),
        
     ]);
   }
   
   /**
    * @inheritDoc
    */
   public function store(StoreCompanyRequest $request) {
      $data = $request->validated();
      /** * @var $image \Illuminate\Http\UploadededFile*/
      $image = $data['logoUrl'] ?? null;
      if($image){
          $path = $image->store('Logo/' . Str::random(), 'public');
          $data['logoUrl'] =   $path;
      }
     $company= Company::create($data);
     $company->countries()->attach($data['countries']);
    return  to_route('company.index')->with('success','Company created successfully');
   }
   
   /**
    * @inheritDoc
    */
   public function update(UpdateCompanyRequest $request, Company $company) {
      $data = $request->validated();
      /** * @var $image \Illuminate\Http\UploadededFile*/
      $image = $data['logoUrl'] ?? null;
     
      if($image){
          if($company->logoUrl){
              Storage::disk('public')->deleteDirectory(dirname($company->logoUrl));
          }
          $data['logoUrl'] = $image->store('Logo/' . Str::random(), 'public');
      }else{
          $data['logoUrl'] = $company->logoUrl;
      }
       // Update the relationship
    $company->countries()->sync($request->input('countries'));
      $company->update($data);
      
      
    return  to_route('company.index')->with('success',"Company \"$company->name\" updated successfully");
   }
}