<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use Illuminate\Support\Facades\Storage;
use File;



class FileManagerController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            // config('file-manager.disks');

            $directory = "public";
            $files = Storage::allFiles($directory);
            $dir = Storage::allFiles($directory);


            $path = public_path('images');
            $filess = File::allFiles($path);

            $img_path = public_path('images');
            $read_dir = scandir($img_path);
            
            // $path = base_path().'/public';
            // return File::put($path , $data);

            // dd($path,$filess,$read_dir,Storage::disk());
        return view('filemanager',compact('files'));
        }
        return redirect("/")->with('error','You are not allowed to access');     
    }

    public function FileUpload(Request $request)
    {
        $user_id  = Auth::user()->id;
       
        $filename  = $request->file('file');
        $file = [
            'file_name' => $filename->getClientOriginalName(),
            'file_size' => $filename->getSize(),
            'file_mime' => $filename->getMimeType(),
            'file_ext'  => $filename->getClientOriginalExtension(),
            'file_path' => $filename->getPathName(),
        ];
        $name = Auth::user()->name;
        $name = explode(' ', trim($name))[0]; // trim(strtolower($name)))[0];
        $path = $name.'-'.time().'/'; 
        $org_filename = $filename->getClientOriginalName();   
       

        if($user_id){
            $data =  User::find($user_id);
            // my_disk_list(($data->file_path !=null) ? $data->file_path : $path);
            $data->file_name = $org_filename;
            $data->file_path   = ($data->file_path !=null) ? $data->file_path : $path;
            $data->folder_name = ($data->file_path !=null) ? $data->file_path : $path;
            // $data->file_path = $path;  
            // $data->folder_name = $path; 
            $updated = $data->update();
            if($updated){
                // dd($data->file_path);
                if( $data->file_path){                
                $filename->move($data->file_path,$org_filename);
                }
                return redirect()->back()->with('error','File updated successfully');     
            }            
        }else{
            $data = new User;
            $data->file_name = $org_filename;
            $data->file_path = $path;  
            $data->folder_name = $path; 
            $updated = $data->update();
            if($updated){
                $filename->move($path,$org_filename);
                return redirect()->back()->with('error','File updated successfully');     
            }            
        }
       
        dd($request->all(), $file,storage_path(), public_path($path)); 
    }


    function loginForm()
    {
        return view('login');
    }


    public function UserRegister()
    {
        return view('register');
    }

    function UserCreate(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);
        return redirect("filemanager")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }


    public function loginCheck(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('filemanager')
                ->withSuccess('Signed in');
        }
        return redirect()->back()->with('error','Email or password are wrong.');
        // return redirect("login")->withSuccess('Login details are not valid');

    }




    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return Redirect('/');
    }
}
