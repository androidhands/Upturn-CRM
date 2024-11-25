<?php
namespace App\Repositories\Admin\Country;

use App\Http\Requests\Admin\Country\StoreCountryRequest;
use App\Http\Requests\Admin\Country\UpdateCountryRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CountryRepository implements CountryRepositoryInterface{
   
   /**
    * @inheritDoc
    */
   public function create() {
      return inertia("Admin/Country/Create");
   }
   
   /**
    * @inheritDoc
    */
   public function destroy(Country $country) {
      $name = $country->name;
      $country->delete();
      if($country->flagUrl){
          Storage::disk('public')->deleteDirectory(dirname($country->flagUrl));
      }
      return to_route('country.index')->with('success', "Country \"$name\" has been deleted successfully");

   }
   
   /**
    * @inheritDoc
    */
   public function edit(Country $country) {
      return inertia("Admin/Country/Edit", [
         'selectedCountry'=> new CountryResource(resource: $country),
         'baseUrl' => request()->getSchemeAndHttpHost()
     ]);
   }
   
   /**
    * @inheritDoc
    */
   public function index() {
      $query = Country::query();
      $sortField = request('sort_field', 'created_at');
      $sortDirection = request('sort_direction', 'asc');
     if(request("id")){
          $query->where("id", "like", request("id"));
     }

      if(request("name")){
          $query->where("name", "like", "%" . request("name") . "%", );
      }
     
     $countires =  $query->orderBy($sortField,$sortDirection)->paginate(10);
      return inertia('Admin/Country/Index', [
          'countries'=> CountryResource::collection($countires),
          'queryParams' => request()->query() ?: null,
          'success'=>session('success'),
         'baseUrl' => request()->getSchemeAndHttpHost()
      ]);
   }
   
   /**
    * @inheritDoc
    */
   public function show(Country $country) {
      return inertia('Admin/Country/Show', [
         'country'=>new CountryResource($country),
        'baseUrl' => request()->getSchemeAndHttpHost(),
        
     ]);
   }
   
   /**
    * @inheritDoc
    */
   public function store(StoreCountryRequest $request) {
      $data = $request->validated();
      /** * @var $image \Illuminate\Http\UploadededFile*/
      $image = $data['flagUrl'] ?? null;
      if($image){
          $path = $image->store('Flag/' . Str::random(), 'public');
          $data['flagUrl'] =   $path;
      }
      Country::create($data);
    return  to_route('country.index')->with('success','Country created successfully');
   }
   
   /**
    * @inheritDoc
    */
   public function update(UpdateCountryRequest $request, Country $country) {

      $data = $request->validated();
      /** * @var $image \Illuminate\Http\UploadededFile*/
      $image = $data['flagUrl'] ?? null;
     
      if($image){
          if($country->flagUrl){
              Storage::disk('public')->deleteDirectory(dirname($country->flagUrl));
          }
          $data['flagUrl'] = $image->store('Flag/' . Str::random(), 'public');
      }else{
          $data['flagUrl'] = $country->flagUrl;
      }
      $country->update($data);
    return  to_route('country.index')->with('success',"Country \"$country->name\" updated successfully");
   }
}