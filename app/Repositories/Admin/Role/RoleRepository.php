<?php
namespace App\Repositories\Admin\Role;

use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\RoleResource;
use App\Models\Company;
use App\Models\Role;

class RoleRepository implements RoleRepositoryInterface{

   /**
     * Display a listing of the resource.
     */
    public function index(Company $company)
    {

        $query = $company->roles();
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');
       if(request("id")){
            $query->where("id", "like", request("id"));
       }

        if(request("name")){
            $query->where("name", "like", "%" . request("name") . "%", );
        }
        if(request("email")){
            $query->where("email", "like", "%" . request("email") . "%", );
        }
       $projects =  $query->orderBy($sortField,$sortDirection)->paginate(10);

        return  inertia('Admin/Role/Index',[
            "roles"=> RoleResource::collection($projects),
            'queryParams' => request()->query() ?: null,
            'success'=>session('success'),
            'company'=>new CompanyResource($company)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Company $company)
    {
        return inertia("Admin/Role/Create",[
            'company'=>new CompanyResource($company),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request, Company $company)
    {
        $data = $request->validated();
      $role =   Role::create($data);
      $role->company()->associate($company);
      $role->save();
      return  to_route('role.index',$company)->with('success','Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company,Role $role)
    {
      return inertia("Admin/Role/Show",[
         "role"=>new RoleResource( $role),
         "company"=> new CompanyResource($company )
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company,Role $role)
    {
        return inertia('Admin/Role/Edit', [
            'role'=>new RoleResource($role),
            'company'=> new CompanyResource($company)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request,Company $company, Role $role)
    {
        $data = $request->validated();
        $role->update($data);
      return  to_route('role.index',$company)->with('success',"Role \"$role->name\" updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company, Role $role)
    {
        $name = $role->name;
        $role->delete();
        return to_route('role.index',$company)->with('success', "Role \"$name\" has been deleted successfully");
    }
}
