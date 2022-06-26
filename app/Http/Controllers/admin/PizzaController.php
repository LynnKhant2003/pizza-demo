<?php

namespace App\Http\Controllers\admin;

use App\Models\pizzas;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PizzaController extends Controller
{
    public function pizza(){
        if (Session::has("PIZZA_LIST")){
            Session::forget("PIZZA_LIST");
        }
        $data = pizzas::paginate(7);
        // dd(count($data));
        if(count($data)==0)
        $emptyStatus = 0;
        else
        $emptyStatus=1;
        // $data = pizzas::where('price','>','1000')->distinct()->get();
        // dd($data->toArray());
        return view('admin.pizza.list')->with(['data'=> $data,'status'=>$emptyStatus]);
    }
    public function addPizza(){
        $data = category::get();

        return view('admin.pizza.add')->with(['category'=>$data]);
    }
    public function insertPizza(Request $request){

        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'image'=>'required',
            'price'=>'required',
            'PublishStatus'=>'required',
            'Category'=>'required',
            'discount'=>'required',
            'b1g1'=>'required',
            'wait'=>'required',
            'description'=>'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $file = $request->file('image');
        $filename = uniqid().'_'.$file->getClientOriginalName();
        $file->move(public_path().'/uploads/',$filename);
        $data = $this->createPizzaData($request,$filename);
        pizzas::create($data);
        return redirect()->route('admin#pizza')->with(['addPizzaSuccess'=>'Pizza added successfully']);

    }
    public function deletePizza($id){
        $data = pizzas::select('image')->where('pizza_id','=',$id)->first();
        $image = $data['image'];

        pizzas::where('pizza_id','=',$id)->delete();
        if(File::exists(public_path().'/uploads/'.$image)){
            File::delete(public_path().'/uploads/'.$image);
        };

        return back()->with(['deleteSuccess'=>'Pizza delete successfully']);
    }
    public function infoPizza($id){
        $data = pizzas::where('pizza_id','=',$id)->first();

        return view('admin.pizza.info')->with(['data'=>$data]);
    }
    public function editPizza($id){
        $category = category::get();
        $data = pizzas::select('*')
                        ->join('categories','pizzas.category_id','=','categories.category_id')
                        ->where('pizza_id','=',$id)
                        ->first();


        return view('admin.pizza.edit')->with(['data'=>$data, 'category'=>$category]);
    }
    public function updatePizza($id,Request $request){
        $validator = Validator::make($request->all(), [
            'name'=>'required',
             'price'=>'required',
            'PublishStatus'=>'required',
            'Category'=>'required',
            'discount'=>'required',
            'b1g1'=>'required',
            'wait'=>'required',
            'description'=>'required',
        ]);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $updateData = $this->updatePizzaData($request);
        if(isset($updateData['image'])){
            $data = pizzas::where('pizza_id','=',$id)->first();
            $filename = $data['image'];
            if(File::exists(public_path().'/uploads/'.$filename)){
                File::delete(public_path().'/uploads/'.$filename);
            }
            $file = $request->file('image');
            $filename=uniqid().'_'.$file->getClientOriginalName();
            $file->move(public_path().'/uploads/',$filename);
            $updateData['image']=$filename;
            pizzas::where('pizza_id','=',$id)->update($updateData);
            return redirect()->route('admin#pizza')->with(['success'=>'Pizza updated']);
        }
        else{
            pizzas::where('pizza_id','=',$id)->update($updateData);
            return redirect()->route('admin#pizza')->with(['success'=>'Pizza updated']);
        }

    }
    public function searchPizza( Request $request){
        $searchData = pizzas::orwhere('name','like','%'.$request->table_search.'%')
                            ->orwhere('price','like','%'.$request->table_search.'%')
                            ->paginate(7);
        Session::put("PIZZA_LIST",$request->table_search);
        $searchData->append($request->all());
        if(count($searchData)==0)
        $emptyStatus=0;
        else
        $emptyStatus=1;
        return view('admin.pizza.list')->with(['data'=>$searchData,'status'=>$emptyStatus]);
    }
    public function downloadPizzaList(){
        if(Session::has('PIZZA_LIST'))
        $pizzaList = pizzas::orwhere('name','like','%'.Session::get('PIZZA_LIST').'%')
        ->orwhere('price','like','%'.Session::get('PIZZA_LIST').'%')
        ->get();
        else{
            $pizzaList = pizzas::get();
        }


        $csvExporter = new \Laracsv\Export();

         $csvExporter->build($pizzaList, [
            'pizza_id' => 'ID',
            'name' => 'Name',
            'price'=>'Price',
            'discount_price'=>"Discount",
            'waiting_time'=>'Waiting Time',
            'description'=>"Description",

        ]);

        $csvReader = $csvExporter->getReader();
        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);
        $filename = 'PizzaList.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }
    private function updatePizzaData($request){
        $arr=[
            'name'=>$request->name,
            // 'image'=>$filename,
            'price'=>$request->price,
            'publish_status'=>$request->PublishStatus,
            'category_id'=>$request->Category,
            'discount_price'=>$request->discount,
            'buy1_get1_status'=>$request->b1g1,
            'waiting_time'=>$request->wait,
            'description'=>$request->description,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ];
        if(isset($request->image)){
            $arr['image']=$request->image;
        }

        return $arr;
    }
    private function createPizzaData($request,$filename){
        return [
            'name'=>$request->name,
            'image'=>$filename,
            'price'=>$request->price,
            'publish_status'=>$request->PublishStatus,
            'category_id'=>$request->Category,
            'discount_price'=>$request->discount,
            'buy1_get1_status'=>$request->b1g1,
            'waiting_time'=>$request->wait,
            'description'=>$request->description,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()

        ];
    }
}
