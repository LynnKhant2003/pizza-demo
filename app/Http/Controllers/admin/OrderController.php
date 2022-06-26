<?php

namespace App\Http\Controllers\admin;

use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function orderlist(){

        $data = order::select('orders.*','users.name','pizzas.name as pizza_name',DB::raw('COUNT(orders.pizza_id) as count'))
        ->join('users','users.id','orders.customer_id')
        ->join('pizzas','pizzas.pizza_id','orders.pizza_id')
                ->groupBy('orders.customer_id','orders.pizza_id')
                ->paginate(9);
        if(count($data)==0){
            $emptyStatus = 0;
        }
        else{
            $emptyStatus=1;
        }
        return view('admin.order.list')->with(['data'=>$data,'emptyStatus'=>$emptyStatus]);
    }
    public function searchOrder(Request $request){
        $data = order::select('orders.*','users.name','pizzas.name as pizza_name',DB::raw('COUNT(orders.pizza_id) as count'))
        ->join('users','users.id','orders.customer_id')
        ->join("pizzas",'pizzas.pizza_id','orders.pizza_id')
        ->orWhere('users.name','like','%'.$request->table_search.'%')
        ->orWhere('pizzas.name','like','%'.$request->table_search.'%')
        ->groupBy("orders.customer_id",'orders.pizza_id')
        ->paginate(9);
        // dd($data);
        if(count($data)==0){
            $emptyStatus = 0;
        }
        else{
            $emptyStatus=1;
        }
        // dd($request->table_search);
        return view('admin.order.list')->with(['data'=>$data,'emptyStatus'=>$emptyStatus]);

    }
}
