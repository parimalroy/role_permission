<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{

    public static function middleware(): array{
        return [
            new Middleware('permission:view user', only:['user_index']),
            // new Middleware('permission:create role', only:['role_create']),
            new Middleware('permission:edit user', only:['user_edit']),
            // new Middleware('premission:view article', only:['article_index']),
        ];
    }

    public function user_index(){
        $users =User::all();
        return view('backend.user.index',['users'=>$users]);
    }

    public function user_edit($id){
        $users=User::find($id);
        $roles=Role::all();
        $hasRole=$users->roles->pluck('id');
        return view('backend.user.edit',[
            'users'=>$users,
            'roles'=>$roles,
            'hasRole'=>$hasRole
        ]);
    }

    public function user_update(Request $request,$id){
        $users=User::find($id);

        $request->validate([
            'name'=>'required',
            'email'=>'required'
        ]);
        $users->name=$request->name;
        $users->email=$request->email;
        $users->save();

        $users->syncRoles($request->role);
        return redirect()->route('user.index')->with('success','user updated!');
       
    }
}
