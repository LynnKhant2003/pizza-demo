<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\pizzas;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{


    public function category(){
        $data = category::select('categories.category_id','categories.category_name',DB::raw('COUNT(pizzas.category_id) as count'))->
                leftJoin('pizzas','pizzas.category_id','categories.category_id')->
                groupBy("categories.category_id")
                ->paginate(7);
    if(Session::has('CATEGORY_SEARCH')){
        Session::forget("CATEGORY_SEARCH");
    }
        // $data = category::count();
        // dd($data);
        return view('admin.category.list')->with(["data"=>$data]);
    }
    public function pizza(){
        return view('admin.pizza.list');
    }
    public function addCategory(){

        return view('admin.category.addCategory');
    }
    public function categoryItem($id){
        $data= pizzas::select('categories.category_name as cName', 'pizzas.*')
                ->join('categories','pizzas.category_id','categories.category_id')
                ->where('pizzas.category_id',$id)
                ->paginate(5);
// dd($data->toArray());
        return view('admin.category.categoryItem')->with(['data'=>$data]);
    }
    public function searchCategory(Request $request){
        // dd($request->table_search);
        $data = category::select('categories.category_id','categories.category_name',DB::raw('COUNT(pizzas.category_id) as count'))->
                leftJoin('pizzas','pizzas.category_id','categories.category_id')->
                groupBy("categories.category_id")
                ->where('categories.category_name','like','%'.$request->table_search.'%')
                ->paginate(7);
        Session::put("CATEGORY_SEARCH",$request->table_search);
        $data->append($request->all());
        return view('admin.category.list')->with(["data"=>$data]);

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

    public function downloadList(){
        // dd();
        if(Session::has('CATEGORY_SEARCH'))
        $categoryList = category::select('categories.category_id','categories.category_name',DB::raw('COUNT(pizzas.category_id) as count'))->
                leftJoin('pizzas','pizzas.category_id','categories.category_id')->
                groupBy("categories.category_id")
                ->where('categories.category_name','like','%'.Session::get('CATEGORY_SEARCH').'%')
                ->get();
        else{
            $categoryList = category::select('categories.category_id','categories.category_name',DB::raw('COUNT(pizzas.category_id) as count'))->
            leftJoin('pizzas','pizzas.category_id','categories.category_id')->
            groupBy("categories.category_id")
            // ->orderBy('categories.category_name','desc')
            ->get();
        }


        $csvExporter = new \Laracsv\Export();

         $csvExporter->build($categoryList, [
            'category_id' => 'ID',
            'category_name' => 'Name',
            'count'=>'Product Count',

        ]);

        $csvReader = $csvExporter->getReader();
        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);
        $filename = 'CategoryList.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }
}
