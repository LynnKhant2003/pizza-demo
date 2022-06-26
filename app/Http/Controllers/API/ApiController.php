<?php

namespace App\Http\Controllers\API;

use Response;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function list(){
        $category = category::get();
    $response = [
        'status' => 'successs',
        'data'=>$category,
    ];
    return Response::json($response);
    }
    public function create(Request $request){
        $data =[
            'category_name' => $request->CategoryName,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];
        category::create($data);

        return Response::json([
            'status'=>200,
            'message'=>'Success',
        ]);
    }
    public function details($id){
        $data = category::where('category_id',$id)->first();
        if(!empty($data)){
            return Response::json(
                [
                    'status'=>200,
                    'message'=>"success",
                    'data'=>$data,
                ]
                );
        };
        return Response::json(
            [
                'status'=>200,
                'message'=>"fails",
                'data'=>$data,
            ]
            );
    }
     public function delete($id){
         $data = category::where('category_id',$id)->first();
         if(empty($data)){
            return Response::json(
                [
                    'status'=>200,
                    'message'=>"There is no such data in table",

                ]
                );
        };
        category::where('category_id',$id)->delete();
        return Response::json(
            [
                'status'=>200,
                'message'=>"Delete Success",

            ]
            );
     }
     public function update(Request $request,$id){

        $update_data = [
            'category_name'=>$request->CategoryName,
        ];
        $check = category::where('category_id',$id)->first();
        if(empty($check)){
            return Response::json(
                ['status' => 200,
                'message'=>'error',]
            );
        }
        category::where('category_id',$id)->update($update_data);
        return Response::json(
            [
                'status'=>200,
                'Message'=>"Update Success",
            ]
            );
     }
}
