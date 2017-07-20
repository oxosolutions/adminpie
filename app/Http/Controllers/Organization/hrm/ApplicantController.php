<?php

namespace App\Http\Controllers\Organization\hrm;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Applicant;
use App\Model\Organization\ApplicantMeta; 
use App\Repositories\User\UserRepositoryContract;
use Session;

class ApplicantController extends Controller
{

     protected $user;
    public function __construct(UserRepositoryContract $user)
    {
        $this->user = $user;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
       //dump(Applicant::with('user_relation')->get());
        $datalist= [];
        $data= [];
          if($request->has('per_page')){
                $perPage = $request->per_page;
                if($perPage == 'all'){
                  $perPage = 999999999999999;
                }
              }else{
                $perPage = 5;
              }
          $sortedBy = @$request->sort_by;
          if($request->has('search')){
              if($sortedBy != ''){
                  $model = Applicant::with('user_relation')->where('id','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                  $model = Applicant::with('user_relation')->where('id','like','%'.$request->search.'%')->paginate($perPage);
              }
          }else{
              if($sortedBy != ''){
                  $model = Applicant::with('user_relation')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
              }else{
                   $model = Applicant::with('user_relation')->paginate($perPage);
              }
          }

         
            $datalist =  [
                          'datalist'=>  $model,
                          'showColumns' => ['id'=>'id', 'user_relation.name'=>'Name','created_at'=>'Created At'],
                          'actions' => [
                                          'edit' => ['title'=>'Edit','route'=>'edit.applicant' , 'class' => 'edit'],
                                          'delete'=>['title'=>'Delete','route'=>'delete.designation']
                                       ],
                          'js'  =>  ['custom'=>['list-designation']],
                          'css'=> ['custom'=>['list-designation']]
                      ];
            return view('organization.applicant.list',$datalist);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->isMethod('post')){
        $tbl = Session::get('organization_id');
        $valid_fields = [   'name'          => 'required',
                            'email'         => 'required|email|unique:'.$tbl.'_users',
                            'password'      => 'required|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/|min:8'
                        ];
        $this->validate($request , $valid_fields);
        $request['role_id'] =  38; //setting_val_by_key('applicant_role');
        $user_id = $this->user->create($request->all(), 2);
        $applicant = new Applicant();
        $applicant->user_id = $user_id;
        $applicant->status = 1;
        $applicant->save();
        }
        return redirect()->route('list.applicant');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $appCheckFirst = ApplicantMeta::where(['applicant_id'=>$id]);
        if($appCheckFirst->exists()){
           $data =  $appCheckFirst->get()->keyBy('key');
           $collection = collect($data->toArray());
            $keyed = $collection->mapWithKeys(function ($item) {
                return [$item['key'] => $item['value']];
            });
$keyed['id'] = $id;
          $model =  $keyed->all();
          //dump($model);
        }

        if($request->isMethod('post')){
            unset($request['_token']);
            foreach ($request->all() as $key => $value) {
                if(is_array($value)){
                    $value = json_encode($value);
                }
               $applicantCheck =  ApplicantMeta::where(['applicant_id'=>$id, 'key'=>$key]);
               if($applicantCheck->exists()){
                    $applicantCheck->update(['value'=>$value]);
                }else{
                  $appMeta =  new ApplicantMeta();
                  $appMeta->applicant_id = $id;
                  $appMeta->key = $key;
                  $appMeta->value = $value;
                  $appMeta->save();
              }
            }
                  return redirect()->route('list.applicant');
            }
      //  dd($model);
         return view('organization.applicant.edit', compact('model'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
