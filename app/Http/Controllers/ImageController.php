<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->path_image = storage_path('app/public/images');
    }

    public function index()
    {
        return view('welcome');
    }

    public function imguploadpost(Request $request){
    	if($request->ajax()){
    	    $data = $request->file('file');
            $filename = $data->hashName();

            if($request->user_id != null) {
                $user = new User();
                $user->image = $filename;
                $user->save();

                $users = User::where('id', $user->id)->first();
            } else {
                $user = User::find($request->user_id);
                $user->image = $filename;
                $user->save();

                $users = User::where('id', $user->id)->first();
            }

            $data->storeAs('public/images', $filename);

            return response()->json([
                'success' => 'done',
                'users'=> $users
            ]);

    	}
    }

    public function store(Request $request){
        if($request->user_id != null) {
            $user = User::where('id', $request->user_id)->first();
            $user->name = $request->name;
            $user->save();
        } else {
            dd('error');
        }

        return redirect()->back();
    }
}
