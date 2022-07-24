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
        $user = User::all();
        return view('welcome', compact('user'));
    }

    public function imguploadpost(Request $request){
    	if($request->ajax()){
    	    $data = $request->file('file');
            $extension = $data->getClientOriginalExtension();
            $filename = csrf_token().'.'.$extension; 

            $usersImage = public_path("storage/images/".$filename);

            if(File::exists($usersImage)) {
                
                User::where('image', $filename)->update(['image' => $filename]);
                
                unlink($usersImage);


                $users = User::where('image', $filename)->first();

                $data->storeAs('public/images', $filename);
            } else {
                // $user = new User();
                // $user->image = $filename;
                // $user->save();
                $user = User::create(['image' => $filename]);

                $users = User::where('id', $user->id)->first();
            
                $data->storeAs('public/images', $filename);
            }

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
