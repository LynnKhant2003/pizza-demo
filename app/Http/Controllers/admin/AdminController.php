<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function profile(){
        $id = auth()->user()->id;
        $data = User::where('id','=',$id)->first()->toArray();
        // dd($data);
        return view('admin.profile.index')->with(['data'=>$data]);
    }
    public function update($id, Request $request){
        $validator = Validator::make($request->all(),[
            'Name'=>'required',
            'Email'=>'required',
            'Phone'=>'required',
            'Address'=>'required'
        ]);
        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $data = $this->updateData($request);
        User::where('id','=',$id)->update($data);
        return back()->with(['updateSuccess'=>"User information Updated"]);
    }
    public function changePassword(){
        return view('admin.profile.changePassword');
    }
    public function confirmPassword($id,Request $request){
        $validator = Validator::make($request->all(),[
            'oldPassword'=>'required',
            'newPassword'=>'required',
            'confirmPassword'=>'required'
        ]);
        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        }
        $oldPassword= $request->oldPassword;
        $newPassword= $request->newPassword;
        $confirmPassword = $request->confirmPassword;
        $passwordData = User::select('password')->where('id','=',$id)->get()->toArray();
        $hashPassword = $passwordData[0]['password'];
        if(Hash::check($oldPassword, $hashPassword)){
            if($newPassword != $confirmPassword){
                return back()->with(['notSameError'=>'Enter same password']);
            }
            else{
                if(strlen($newPassword)<=6 || strlen($confirmPassword)<=6){
                    return back()->with(['lengthError'=>'password must be greater than 6 characters']);
                }
                else{
                    $hash = Hash::make($confirmPassword);
                    User::where('id','=',$id)->update([
                        'password' => $hash,
                    ]);
                    return back()->with(['success'=>'Password change successfully']);

                }
            }
        }
        else{
            return back()->with(['passwordError'=>'Enter correct password']);
        }

    }
    private function updateData($request){
        return [
            'name'=>$request->Name,
            'email'=>$request->Email,
            'phone'=>$request->Phone,
            'address'=>$request->Address
        ];
    }
}
