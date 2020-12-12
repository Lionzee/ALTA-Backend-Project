<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index(Request $request){

        if($request->category){
            $data = Product::orderBy('id','DESC')
                ->where('category_id',$request->category)
                ->where('stock','>', 0)
                ->paginate(20);
        }else{
            $data = Product::orderBy('id','DESC')
                ->where('stock','>',  0)
                ->paginate(20);
        }

        if($data){
            return response()->json([
                "errorCode" => "00",
                "message" => "success get products",
                "data" => $data
            ]);
        }else{
            return response()->json([
                "errorCode" => "00",
                "message" => "Currently there is no product listed",
                "data" => $data
            ]);
        }

    }


    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $data = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return response()->json([
            "error_code" => "00",
            "message" => "item add success : product created",
            "data" => $data,
        ]);

    }
}
