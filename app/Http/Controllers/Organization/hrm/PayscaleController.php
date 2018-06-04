<?php
namespace App\Http\Controllers\Organization\hrm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Payscale;
class PayscaleController extends Controller
{
    public function store(Request $request){
        if($request->isMethod('post')){
            $payscale = new Payscale();
            $payscale->fill($request->except('_token'));
            $payscale->save();
        }
        return redirect()->route('list.payscale');
    }
    public function index(Request $request , $id=null)
    {
        $datalist= [];
        $data= [];
        if($request->has('items')){
            $perPage = $request->items;
            if($perPage == 'all'){
                $perPage = 999999999999999;
            }
        }else{
            $perPage = get_items_per_page();;
        }
        $sortedBy = @$request->orderby;
        if($request->has('search')){
            if($sortedBy != ''){
                $model = Payscale::where('title','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                $model = Payscale::where('title','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $model = Payscale::orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                $model = Payscale::paginate($perPage);
            }
        }
        $datalist =  [
            'datalist'=>  $model,
            'showColumns' => ['title'=>'Name','created_at'=>'Created'],
            'actions' => [
                'edit' => ['title'=>'Edit','route'=>'edit.payscale' , 'class' => 'edit'],
                'delete'=>['title'=>'Delete','route'=>'delete.payscale']
            ],
            'js'  =>  ['custom'=>['list-designation']],
            'css'=> ['custom'=>['list-designation']]
        ];
        if(!empty($id) || $id != null || $id != ''){
            $data['data'] = Payscale::where('id',$id)->first();
        }
        return view('organization.hrm.pay-scale.pay-scales',$datalist)->with(['data' => $data]);
    }
    public function delete($id){
        Payscale::where('id', $id)->delete();
        return redirect()->route('list.payscale');
    }
    public function edit(Request $request , $id){
        if ($request->isMethod('post')) {
            $model = Payscale::where('id',$id);
            $model->update($request->except('_token','action'));
            return redirect()->route('list.payscale');		
        }else{
            $data['data'] = Payscale::where('id',$id)->first();
            return view('organization.hrm.pay-scale.edit-pay-scale',['data' => $data]);	
        }
    }    
    public function add()
    {
        return view('organization.hrm.pay-scale.add-pay-scale');
    }
}
