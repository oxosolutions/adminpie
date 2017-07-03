<?php

namespace App\Http\Controllers\Organization\project;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Notes as NT;
use Session;
use Illuminate\Support\Facades\Hash;


class NotesController extends Controller
{
    public function index(){
        $viewFrom = request()->segment(1);
        if($viewFrom == 'account'){
            $viewFrom = 'profile';
        }
    	$plugins = ['js' => ['custom'=>['notes']]];
    	return view('organization.'.$viewFrom.'.notes',['plugins' => $plugins]);
    }
    public function createNotes(Request $request)
    {
    	$data = new NT;
    	$data->fill($request->except('_token'));
    	$data->save();

    	$modal = NT::all();
    	return view('organization.project._note',['modal'=>$modal])->render();
    }
    function listNotes(){
    	$modal = NT::all();
    	return view('organization.project._note',['modal'=>$modal])->render();
    }
    public function edit(Request $request){
        $id = $request->id;
        $data = [
                    'title'=> $request->title,
                    'description'=> $request->description
                ];
        $modal = NT::where('id',$id)->update($data);
        return 'update successfully';
        

    }
}
