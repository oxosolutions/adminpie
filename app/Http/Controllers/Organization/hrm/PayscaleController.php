<?php
namespace App\Http\Controllers\Organization\hrm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Payscale;
use Session;
class PayscaleController extends Controller
{
    /**
     * { function_description }
     * @param      \Illuminate\Http\Request  $request  The request
     * @return     <type>                    ( description_of_the_return_value )
     */
    public function store(Request $request){
        $this->validatePayScalePost($request);
        $payscale = new Payscale();
        $payscale->title = $request->title;
        $payscale->description = $request->description;
        $payscale->currency = $request->currency;
        $payscale->pay_cycle = $request->pay_cycle;
        $payscale->basic_pay = $request->basic_pay;
        $payscale->allowances = json_encode($request->allowances);
        $payscale->deductions = json_encode($request->deductions);
        $payscale->net_salary = $request->net_salary;
        $payscale->save();
        Session::flash('success','Payscale saved successfully!');
        return redirect()->route('list.payscale');
    }


    protected function validatePayScalePost($request){
        $rules = [
            'title' => 'required',
            'currency' => 'required',
            'pay_cycle' => 'required',
            'basic_pay' => 'required',            
        ];

        $this->validate($request,$rules);
    }


    /**
     * { function_description }
     *
     * @param      \Illuminate\Http\Request  $request  The request
     * @param      string                    $id       The identifier
     * @return     <type>                    ( description_of_the_return_value )
     */
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

    /**
     * { function_description }
     *
     * @param      <type>  $id     The identifier
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function delete($id){
        Payscale::where('id', $id)->delete();
        return redirect()->route('list.payscale');
    }


    /**
     * { function_description }
     *
     * @param      \Illuminate\Http\Request  $request  The request
     * @param      <type>                    $id       The identifier
     * @return     <type>                    ( description_of_the_return_value )
     */
    public function edit(Request $request , $id){
        if ($request->isMethod('post')) {
            $this->validatePayScalePost($request);
            $payscale = Payscale::find($id);
            $payscale->title = $request->title;
            $payscale->description = $request->description;
            $payscale->currency = $request->currency;
            $payscale->pay_cycle = $request->pay_cycle;
            $payscale->basic_pay = $request->basic_pay;
            $payscale->allowances = json_encode($request->allowances);
            $payscale->deductions = json_encode($request->deductions);
            $payscale->net_salary = $request->net_salary;
            $payscale->save();
            Session::flash('success','Payscale updated successfully!');
            return redirect()->route('list.payscale');      
        }else{
            $data = Payscale::where('id',$id)->first();
            $data['allowances'] = json_decode($data['allowances'],true);
            $data['deductions'] = json_decode($data['deductions'],true);
            return view('organization.hrm.pay-scale.edit-pay-scale',['data' => $data]); 
        }
    }    


    public function add(){

        return view('organization.hrm.pay-scale.add-pay-scale');
    }
}
