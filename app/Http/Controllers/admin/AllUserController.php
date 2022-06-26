<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllUserController extends Controller
{
    public function userlist(){
        $data = User::where('role','=','user')->paginate(7);

        return view('admin.user.userlist')->with(['userdata'=>$data]);
    }
    public function adminlist(){
        $data = User::where('role','=','admin')->paginate(7);
        return view('admin.user.adminlist')->with(['userdata'=>$data]);
    }
    public function searchUser(Request $request){
        $data = $this->search('user',$request);
        return view('admin.user.userlist')->with(['userdata'=>$data]);
    }
    public function searchAdmin(Request $request){
        $data = $this->search('admin',$request);
        return view('admin.user.adminlist')->with(['userdata'=>$data]);
    }
    public function deleteUser($id){
        User::where('id','=',$id)->delete();
        return back()->with(['deleteSuccess'=>"User delete successfully"]);
    }
    public function editAdmin($id){
        return view('admin.user.editAdmin');
    }
    private function search($role,$request){
        $data = User::where('role','=',$role)
                    ->where(function($query) use($request){
                    $query->orwhere('name','like','%'.$request->table_search.'%')
                    ->orwhere('email','like','%'.$request->table_search.'%')
                    ->orwhere('phone','like','%'.$request->table_search.'%')
                    ->orwhere('address','like','%'.$request->table_search.'%');
                    })->paginate(7);

        $data->append($request->all());
        return $data;
    }
}
