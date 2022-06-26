<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function profile(){
        $id = auth()->user()->id;
        $data = User::where('id','=',$id)->first()->toArray();
        return view('admin.profile.index')->with(['data'=>$data]);
    }
    public function category(){
        $data = Category::paginate(7);
        return view('admin.category.list')->with(["data"=>$data]);
    }
    public function pizza(){
        return view('admin.pizza.list');
    }
    public function addCategory(){

        return view('admin.category.addCategory');
    }
    public function creatCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            "category_name"=>$request->name
        ];
        category::create($data);
        return redirect()->route('admin#category')->with(["categorySuccess"=>"Category Added......"]);
    }
    public function deleteCategory($id){
        category::where('category_id',"=",$id)->delete();
        return back()->with(['deleteSuccess'=>'Delete Successfully']);
    }
    public function editCategory($id){
        $data = category::where('category_id','=',$id)->first();
        return view('admin.category.edit')->with(['data'=>$data]);
    }
    public function updateCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();

        }
        $updateData = [
            'category_name'=>$request->name
        ];
        category::where('category_id','=',$request->id)->update($updateData);
        return redirect()->route('admin#category')->with(['editSuccess'=>'Category edited Successfully']);
    }
    public function searchCategory(Request $request){
        // dd($request->table_search);
        $data = category::where('category_name','like','%'.$request->table_search.'%')->paginate(7);
        return view('admin.category.list')->with(["data"=>$data]);

    }

}
