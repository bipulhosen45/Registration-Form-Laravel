<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\District;
use App\Models\Division;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Admin $admin)
    {
        $divisions = Division::get();
        $register = Admin::get();
        return view('admin.register.index', compact('register', 'divisions'));
    }
    public function create()
    {
        $divisions = Division::get();
        
        return view('admin.register.form', compact('divisions'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|max:25',
            'confirm_password' => 'required|min:8|max:25',
            'dateofbirth' => 'required',
            'skill' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg |max:2000',
        ]);

        $data = array();

        $image = $request->file('image');
        $slug = str_slug($request->name);
        
        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.'.'.$image->getClientOriginalExtension();
            if(!file_exists('uploads/registration')){
                mkdir('uploads/registration', 077, true);
            }
            $image->move('uploads/registration', $imageName);
        }else{
            $imageName = 'default.png';
        }
        
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['confirm_password'] = Hash::make($request->confirm_password);;
        $data['dateofbirth'] = $request->dateofbirth;
        $data['skill'] = $request->skill;
        $data['image'] = $imageName;

        DB::table('admins')->insert($data);
        toastr()->success('Data has been saved successfully!', 'Success');
        return redirect()->route('registration.index');
    }

    // registration edit
    public function edit($id)
    {
        $data = DB::table('admins')->find($id);
        $divisions = Division::get();
        return view('admin.register.edit', compact('data', 'divisions'));
    }

    // User register updates
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|max:25',
            'confirm_password' => 'required|min:8|max:25',
            'dateofbirth' => 'required',
            'skill' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
        ]);

        $data =  Admin::find($id);

        $image = $request->file('image');
        $slug = str_slug($request->name);
        
        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.'.'.$image->getClientOriginalExtension();
            if(!file_exists('uploads/registration')){
                mkdir('uploads/registration', 077, true);
            }
            $image->move('uploads/registration', $imageName);
        }else{
            $imageName = $data->image;
        }
       
        $data->division_id = $request->division_id;
        $data->district_id = $request->district_id;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->confirm_password = Hash::make($request->confirm_password);
        $data->dateofbirth = $request->dateofbirth;
        $data->skill = $request->skill;
        $data->dateofbirth = $request->dateofbirth;
        $data->image = $imageName;
        $data->save();
        
        toastr()->success('Data has been updated successfully!', 'Success');
        return redirect()->route('registration.index');
    }

    public function destroy($id)
    {
        $data = Admin::find($id);

        if(file_exists('uploads/registration/'.$data->image)){
            unlink('uploads/registration/'.$data->image);
        };
        $data->delete();

        toastr()->success('Data has been delete successfully!', 'Delete');
        return redirect()->back();
    }


}


