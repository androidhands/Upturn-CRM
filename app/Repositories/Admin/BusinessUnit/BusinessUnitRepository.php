<?php
namespace App\Repositories\Admin\BusinessUnit;

use App\Http\Requests\Admin\BusinessUnit\StoreBusinessUnitRequest;
use App\Http\Requests\Admin\BusinessUnit\UpdateBusinessUnitRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\BusinessUnitResource;
use App\Models\Company;
use App\Models\BusinessUnit;

class BusinessUnitRepository implements BusinessUnitRepositoryInterface{
   
   /**
     * Display a listing of the resource.
     */
    public function index(string $companyId)
    {

        $query = Company::find($companyId)->businessUnits();
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');
       if(request("id")){
            $query->where("id", "like", request("id"));
       }

        if(request("name")){
            $query->where("name", "like", "%" . request("name") . "%", );
        }
        
       $businsUnits =  $query->orderBy($sortField,$sortDirection)->paginate(10);
       $company = Company::find($companyId);
      
        return  inertia('Admin/BusinessUnit/Index',[
            "businessUnits"=> BusinessUnitResource::collection($businsUnits),
            'queryParams' => request()->query() ?: null,
            'success'=>session('success'),
            'company'=>new CompanyResource($company)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $companyId)
    {
        $company = Company::find($companyId);
        return inertia("Admin/BusinessUnit/Create",[
            'company'=>new CompanyResource($company),   
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBusinessUnitRequest $request, string $companyId)
    {
        $data = $request->validated();
        $company = Company::find($companyId);
      $businessUnit =   BusinessUnit::create($data);
      $businessUnit->company()->associate($company);
      $businessUnit->save();
      return  to_route('businessUnit.index',$company)->with('success','BusinessUnit created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $companyId,string $businessUnitId)
    {
        $company = Company::find($companyId);
        $businessUnit = BusinessUnit::find($businessUnitId);
      return inertia("Admin/BusinessUnit/Show",[
         "businessUnit"=>new BusinessUnitResource( $businessUnit),
         "company"=> new CompanyResource($company )  
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $companyId,string $businessUnitId)
    {  $company = Company::find($companyId);
        $businessUnit = BusinessUnit::find($businessUnitId);
        return inertia('Admin/BusinessUnit/Edit', [
            'businessUnit'=>new BusinessUnitResource($businessUnit),
            'company'=> new CompanyResource($company)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBusinessUnitRequest $request,string $companyId, string $businessUnitId)
    {
        $data = $request->validated();
        $password = $data['password'] ?? null;
        if($password){
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }
        $company = Company::find($companyId);
        $businessUnit = BusinessUnit::find($businessUnitId);
        $businessUnit->update($data);
      return  to_route('businessUnit.index',$company)->with('success',"BusinessUnit \"$businessUnit->name\" updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $companyId, string $businessUnitId)
    {
        $company = Company::find($companyId);
        $businessUnit = BusinessUnit::find($businessUnitId);
        $name = $businessUnit->name;
        $businessUnit->delete();
        return to_route('businessUnit.index',$company)->with('success', "BusinessUnit \"$name\" has been deleted successfully");
    }
}