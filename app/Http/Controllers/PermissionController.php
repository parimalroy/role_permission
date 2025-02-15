<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller implements HasMiddleware
{
    public static function middleware(): array{
        return [
            new Middleware('permission:view permission', only:['permission_index']),
            new Middleware('permission:create permission', only:['permission_create']),
            new Middleware('permission:edit permission', only:['permission_edit']),
            // new Middleware('premission:view article', only:['article_index']),
        ];
    }


    public function permission_index(){

        $permissionLists=Permission::all();
        return view('backend.permission.index',['permissionLists'=>$permissionLists]);
    }

    public function permission_create(){
        return view('backend.permission.create');
    }

    public function permission_store(Request $request){
        $request->validate([
            'name'=>'required|min:5|max:255|unique:permissions'
        ]);

       $permission= Permission::create([
            'name'=>$request->name
        ]);

        if($permission){
            return redirect()->route('permission.index')->with('success','Permission added!');
        }else{
            return redirect()->route('permission.create')->with('errror','permission not added');
        }


    }


    public function permission_edit($id){

        $permission =Permission::find($id);
        
        return view('backend.permission.edit',['permission'=>$permission]);
    }

    public function permission_update(Request $request,$id){
        $request->validate([
            'name'=>'required|min:5|max:255|unique:permissions'
        ]);

        $permission=Permission::where('id',$id)
            ->update([
                'name'=>$request->name,
            ]);

            if($permission){
                return redirect()->route('permission.index')->with('success','Permission updated!');
            }else{
                return redirect()->route('permission.index')->with('errror','permission not updated');
            }
    }
}
