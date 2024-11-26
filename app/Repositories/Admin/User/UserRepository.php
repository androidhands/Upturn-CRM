<?php
namespace App\Repositories\Admin\User;

use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\UserResource;
use App\Models\Company;
use App\Models\User;

class UserRepository implements UserRepositoryInterface{
   
   /**
     * Display a listing of the resource.
     */
    public function index(Company $company)
    {

        $query = $company->users();
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
      
        return  inertia('Admin/User/Index',[
            "users"=> UserResource::collection($projects),
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
        return inertia("Admin/User/Create",[
            'company'=>new CompanyResource($company),   
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request, Company $company)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
      $user =   User::create($data);
      $user->company()->associate($company);
      $user->save();
      return  to_route('user.index',$company)->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company,User $user)
    {
      return inertia("Admin/User/Show",[
         "user"=>new UserResource( $user),
         "compnay"=> new CompanyResource($company )  
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company,User $user)
    {
        return inertia('Admin/User/Edit', [
            'user'=>new UserResource($user),
            'company'=> new CompanyResource($company)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request,Company $company, User $user)
    {
        $data = $request->validated();
        $password = $data['password'] ?? null;
        if($password){
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }
       
        $user->update($data);
      return  to_route('user.index',$company)->with('success',"User \"$user->name\" updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company, User $user)
    {
        $name = $user->name;
        $user->delete();
        return to_route('user.index',$company)->with('success', "User \"$name\" has been deleted successfully");
    }
}