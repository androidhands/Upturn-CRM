<?php
namespace App\Repositories\Admin\Department;

use App\Http\Requests\Admin\Department\StoreDepartmentRequest;
use App\Http\Requests\Admin\Department\UpdateDepartmentRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\DepartmentResource;
use App\Models\Company;
use App\Models\Department;

class DepartmentRepository implements DepartmentRepositoryInterface{

   /**
     * Display a listing of the resource.
     */
    public function index(string $companyId)
    {

        $query = Company::find($companyId)->departments();
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

        return  inertia('Admin/Department/Index',[
            "departments"=> DepartmentResource::collection($businsUnits),
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
        return inertia("Admin/Department/Create",[
            'company'=>new CompanyResource($company),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request, string $companyId)
    {
        $data = $request->validated();
        $company = Company::find($companyId);
      $department =   Department::create($data);
      $department->company()->associate($company);
      $department->save();
      return  to_route('department.index',$company)->with('success','Department created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $companyId,string $departmentId)
    {
        $company = Company::find($companyId);
        $department = Department::find($departmentId);
      return inertia("Admin/Department/Show",[
         "department"=>new DepartmentResource( $department),
         "company"=> new CompanyResource($company )
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $companyId,string $departmentId)
    {  $company = Company::find($companyId);
        $department = Department::find($departmentId);
        return inertia('Admin/Department/Edit', [
            'department'=>new DepartmentResource($department),
            'company'=> new CompanyResource($company)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request,string $companyId, string $departmentId)
    {
        $data = $request->validated();
        $password = $data['password'] ?? null;
        if($password){
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }
        $company = Company::find($companyId);
        $department = Department::find($departmentId);
        $department->update($data);
      return  to_route('department.index',$company)->with('success',"Department \"$department->name\" updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $companyId, string $departmentId)
    {
        $company = Company::find($companyId);
        $department = Department::find($departmentId);
        $name = $department->name;
        $department->delete();
        return to_route('department.index',$company)->with('success', "Department \"$name\" has been deleted successfully");
    }
}
