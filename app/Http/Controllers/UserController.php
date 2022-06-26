<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\order;
use App\Models\pizzas;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $data = pizzas::where('publish_status','1')->paginate(6);
        $category = category::get();
        $status = count($data) == 0 ? 0 : 1;

        // dd($category->toArray());
        // dd($data->toArray());
        return view('user.home')->with(['data'=>$data,'category'=>$category,'status'=>$status]);
    }

    public function search($id){
        $data = pizzas::where('category_id',$id)
        ->where('publish_status','1')
        ->paginate(6);
        $category = category::get();
        $status = count($data) == 0 ? 0 : 1;

        return view('user.home')->with(['data'=>$data,'category'=>$category, 'status' => $status]);

    }
    public function searchItem(Request $request){
        $data = pizzas::where('name','like','%'.$request->searchTable.'%')
        ->where('publish_status','1')
        ->paginate(6);

        $category = category::get();
        $status = count($data) == 0 ? 0 : 1;
        $data->append($request->all());
        return view('user.home')->with(['data'=>$data,'category'=>$category, 'status' => $status]);

    }
    public function searchByPrice(Request $request){
        $data = pizzas::select('*');
        if(!is_null($request->start_date) && is_null($request->end_date))
            $data = $data->whereDate('created_at','>=',$request->start_date );
        elseif(is_null($request->start_date) && !is_null($request->end_date))
            $data = $data->where('created_at','<=',$request->end_date );
        elseif(!is_null($request->start_date) && !is_null($request->end_date)){
            $data = $data->where('created_at','>=',$request->start_date )
                    ->where('created_at','<=',$request->end_date );
    }
    if(!is_null($request->min_price) && is_null($request->max_price))
        $data = $data->where('price','>=',$request->min_price );
    elseif(is_null($request->min_price) && !is_null($request->max_price))
        $data = $data->where('price','<=',$request->max_price );
    elseif(!is_null($request->min_price) && !is_null($request->max_price)){
        $data = $data->where('price','>=',$request->min_price )
                    ->where('price','<=',$request->max_price );
    }

    $data = $data->where('publish_status','1')->paginate(6);
    $category = category::get();
        $status = count($data) == 0 ? 0 : 1;
        $data->append($request->all());
        return view('user.home')->with(['data'=>$data,'category'=>$category, 'status' => $status]);

    }
    public function details($id){
        $data = pizzas::where('pizza_id',$id)->first();
        Session::put('Pizza_INFO',$data->toArray());

        return view('user.details')->with(['data'=>$data]);
    }
    public function order(){
        $pizza_info = Session::get('Pizza_INFO');
        return view('user.order')->with(['data'=>$pizza_info]);

    }
    public function placeOrder(Request $request){
        $validator = Validator::make($request->all(),[
            'pizza_count'=>'required',
            'paymentType'=>'required',

        ]);
        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $pizza_info = Session::get('Pizza_INFO');
        // dd($pizza_info);
        $customer_id  = Auth()->user()->id;
        $data = $this->requestOrderData($customer_id,$pizza_info,$request);

        for( $i = 0; $i < $request->pizza_count; $i++){
            order::create($data);
        }

        $total_time = $request->pizza_count * $pizza_info['waiting_time'];
        return back()->with(['success'=>"Order Successful, please wait $total_time"]);
    }
    private function requestOrderData($customer_id,$pizza_info,$request){
        return[
            'customer_id'=>$customer_id,
            'pizza_id'=>$pizza_info['pizza_id'],
            'carrier_id'=>0,
            'payment_status'=>$request->paymentType,
            'order_time'=>Carbon::now(),
        ];
    }
}
