<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use DB;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = DB::table('users')->get();
            return returnFormate('success_msg', $users, 'fetch_query');
        } catch (\Throwable $th) {
            return returnFormate('error_msg', null, 'error_query', $th->getCode());
        }
    }

    public function userView(Request $request)
    {
        try {
            $users = User::find($request->id);
            return returnFormate('success_msg', $users, 'fetch_query', true);
        } catch (\Throwable $th) {
            return returnFormate('error_msg', null, 'error_query', $th->getCode());
        }
    }
    public function userEditView(Request $req)
    {
        try {
            $id = $req->id;
            $users = User::find($id);
            return returnFormate('success_msg', $users, 'fetch_query', true);
        } catch (\Throwable $th) {
            return returnFormate('error_msg', null, 'error_query', $th->getCode());
        }
    }
    public function userUpdate(Request $request)
    {
        try {
            $contact = User::find($request->id);
            $input = $request->all();
            $contact->name = $request->name;
            $contact->dob = $request->dob;
            if($request->password !== null) {
                $contact->dob = Hask::make($request->password);
            }
            $contact->update();
            return returnFormate('success_msg', $contact, 'update_query', true);
        } catch (\Throwable $th) {
            return returnFormate('error_msg', null, 'error_query', $th->getCode());
        }
    }

    public function userDestroy(Request $req)
    {
        try {
            $id = $req->id;
            $user = User::findOrFail($id);
            $name = $user->name;
            $user->delete();
            return returnFormate('success_msg', $name, 'delete_query');
        } catch (\Throwable $th) {
            return returnFormate('error_msg', 'User', $th->getCode());
        }
    }

    public function registerUser(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'dob' => 'required',
                'password' => 'required|min:6|max:20',
            ]);
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->dob = $request->dob;
            $user->password = Hash::make($request->password);

            $user->save();
            return returnFormate('success_msg', $user->name, 'insert_query', true);
        } catch (\Throwable $th) {
            return returnFormate('error_msg', 'User', $th->getCode());
        }
    }
}

