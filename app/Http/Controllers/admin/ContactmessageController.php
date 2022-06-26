<?php

namespace App\Http\Controllers\admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactmessageController extends Controller
{
    public function index(){
        $data = Contact::orderBy('contact_id','desc')->paginate(7);
        if(count($data)==0){
            $emptyStatus = 1;
        }
        else{
            $emptyStatus=0;
        }
        return view('admin.contact.list')->with(['data'=>$data,'emptyStatus'=>$emptyStatus]);
    }
    public function search(Request $request){
        $data = Contact::orwhere('name','like','%'.$request->table_search.'%')
                        ->orwhere('email','like','%'.$request->table_search.'%')
                        ->orwhere('message','like','%'.$request->table_search.'%')
                        ->paginate(7);
                        $data->append($request->all());
                        if(count($data)==0){
                            $emptyStatus = 1;
                        }
                        else{
                            $emptyStatus=0;
                        }
                        return view('admin.contact.list')->with(['data'=>$data,'emptyStatus'=>$emptyStatus]);

    }
}
