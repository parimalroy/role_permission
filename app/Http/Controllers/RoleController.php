<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array{
        return [
            new Middleware('permission:view role', only:['role_index']),
            new Middleware('permission:create role', only:['role_create']),
            new Middleware('permission:edit role', only:['role_edit']),
            // new Middleware('premission:view article', only:['article_index']),
        ];
    }


    public function role_index(){
        $roles =Role::orderBy('id','desc')->get();
        return view('backend.role.index',['roles'=>$roles]);
    }

    public function role_create(){
        $permissions = Permission::get();
        return view('backend.role.create',['permissions'=>$permissions]);
    }

    public function role_store(Request $request){
        $request->validate([
            'name'=>'required|min:3|max:255|unique:roles'
        ]);

       $role= Role::create([
            'name'=>$request->name
        ]);
        if(!empty($request->permissions)){
            foreach($request->permissions as $permission){
                $role->givePermissionTo($permission);
            }
        }

        if($permission){
            return redirect()->route('role.index')->with('success','role added!');
        }else{
            return redirect()->route('role.create')->with('error','role not added');
        }
    }

    public function role_edit($id){

        $roles=Role::find($id);
        $hasPermission=$roles->permissions->pluck('name');
        $permissions=Permission::all();
        
        return view('backend.role.edit',['roles'=>$roles,'hasPermission'=>$hasPermission,'permissions'=>$permissions]);
    }

    public function role_update(Request $request,$id){
        $request->validate([
            'name'=>'required|min:3|max:255|unique:roles,name,'.$id.',id'
        ]);

        $role=Role::findOrFail($id);
        $role->name=$request->name;
        $role->save();

        if(!empty($request->permissions)){
            // dd($request->permissions);
            $role->syncPermissions($request->permissions);
        }else{
            $role->syncPermissions([]);
        }
        if($role){
            return redirect()->route('role.index')->with('success','role updated!');
        }else{
            return redirect()->route('role.create')->with('error','role not updated');
        }
    }

}
