<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
        $users = Users::OrderBy("id","DESC")->paginate(10);

        $output = [
            "message" => "Users",
            "result" => $users
        ];

        return response()->json($users, 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $users = Users::create($input);

        return response()->json($users,200);
    }

    public function show($id){
        $users = Users::find($id);

        if(!$users){
            abort(404);
        }

        return response()->json($users, 200);
    }

    public function update(Request $request, $id)
    {
        $input =$request->all();

        $users = Users::find($id);

        if (!$users){
            abort(404);
        }

        $users->fill($input);
        $users->save();

        return response()->json($users,200);
    }

    public function delete($id)
    {
        $users = Users::find($id);

        if(!$users){
            abort(404);
        }

        $users->delete();
        $message = ['message' => 'Deleted successfully','users_id' => $id];

        return response()->json($message,200);
    }
}