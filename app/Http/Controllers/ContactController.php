<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'message'=>'required',
        ]);
        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        };
        $data = $this->updateData($request);
// dd($data);
        Contact::create($data);
        return back()->with(['success'=>'Message sent']);

    }
    private function updateData($request){
        return [
            'user_id' => Auth()->user()->id,
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
        ];
    }
}
