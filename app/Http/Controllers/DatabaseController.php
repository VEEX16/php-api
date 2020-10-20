<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;

class DatabaseController extends Controller {

    public function getDatabase(){
        
        $data = DB::table('migrations')->get();

        return response()->json($data, 200);
    }

    public function getDatabaseByID($id){
        
        $data = DB::table('migrations')->where('id', $id)->get();

        if( count($data) < 1){
            return response()->json(["message" => "Record not found"], 404);
        }else{
            return response()->json($data, 200);
        }
    }

    public function getDatabasePagination(){
        
        $data = DB::table('migrations')->paginate(1);

        if( count($data) < 1){
            return response()->json(["message" => "Record not found"], 404);
        }else{
            return response()->json($data, 200);
        }
    }

    public function dbSave(Request $request){

        $rules = [
            'name' => 'required|min:3',
            'test' => 'required|min:3|max:5'
        ];
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }else{
            $data=array(
                "name"=>$request->input('name'),
                "test"=>$request->input('test'),
            );
    
            DB::table('test')->insert($data);
    
            return response()->json($data, 201);
        }
    }

    
    public function updateRecord(Request $request, $id){

        if ( (DB::table('test')->where('id', $id)->exists()) ){
        
            $data=array(
                "name"=>$request->input('name'),
                "test"=>$request->input('test'),
            );

            DB::table('test')->where('id', $id)->update($data);

            return response()->json($data, 200);
        }else{
            return response()->json(["message" => "Record not found"], 404);
        }
    }

    public function deleteRecord($id){
    
        if ( (DB::table('test')->where('id', $id)->exists()) ){
            DB::table('test')->where('id', $id)->delete();

            return response()->json(null, 204);
        }else{
            return response()->json(["message" => "Record not found"], 404);
        }
    }

    public function downloadFile(){
    
        return response()->download(public_path('images/uec.png'), 'Logo');
    }

    public function saveFile(Request $request){
    
        $fileName = 'user_image.png';
        $path = $request->file('photo')->move(public_path('images/'), $fileName);
        $photoURL = url('images/'.$fileName);

        return response()->json(['url' => $photoURL], 200);
    }

}