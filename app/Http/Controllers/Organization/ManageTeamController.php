<?php

namespace App\Http\Controllers\Organization;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Team;
use App\Model\Organization\User;

class ManageTeamController extends Controller
{
    public function create()
    {
        return View('organization.team.create');
    }
    Public function listTeam(Request $request , $id = null) 
    {
      // if($id != null){
      //   $data = Team::where('id',$id)->get();
      // }
        $datalist= [];
        $data= [];
            if($request->has('per_page')){
                $perPage = $request->per_page;
                if($perPage == 'all'){
                  $perPage = 999999999999999;
                }
            }else{
                $perPage = get_items_per_page();;
            }
            
            $sortedBy = @$request->sort_by;
            if($request->has('search')){
                if($sortedBy != ''){
                    $model = Team::where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
                }else{
                    $model = Team::where('name','like','%'.$request->search.'%')->paginate($perPage);
                }
            }else{
                if($sortedBy != ''){
                    $model = Team::orderBy($sortedBy,$request->desc_asc)->paginate($perPage);
                }else{
                    $model = Team::paginate($perPage);
                }
            }
          // foreach($model as $key => $value){
          //   $user_data = User::whereIn('id',json_decode($value->member_ids))->get();
          //   $model[] = $user_data;
          // }
            $datalist =  [
                        'datalist'=>  $model,
                        'showColumns' => ['title'=>'Title','created_at'=>'Created'],
                        'actions' => [
                                        'edit' => ['title'=>'Edit','route'=>'editinfo.team' , 'class' => 'edit'],
                                        'delete'=>['title'=>'Delete','route'=>'delete.team']
                                     ],
                        'js'  =>  ['custom'=>['list-designation']],
                        'css'=> ['custom'=>['list-designation']]
                      ];
        // $id = null;
            if(!empty($id) || $id != null || $id != ''){
                $data['data'] = Team::where('id',$id)->first();
            }
            return view('organization.team.list',$datalist)->with(['data' => $data]);
        /*$plugins = [
                        'js' => ['select2']
                    ];
    	$team_data = Team::orderBy('id','desc')->get();
    	return view('organization.team.list',['team_data'=>$team_data,'plugins'=>$plugins]);*/
    }
    public function getTeamById($id)
    {
        $data = Team::find($id);
        return view('organization.team.edit',compact('data'));
    }
    public function save(Request $request)
    {   
	    $team = new Team();
        $team->title = $request->title;
        $team->description = $request->description;
        $team->member_ids = json_encode($request->member_ids);
	    $team->save();

	    return redirect()->route('list.team');
    }
    public function deleteTeam($id)
    {
        $model = Team::where('id',$id)->delete();
        if($model){
            return back();
        }
    }
    public function info($id)
    {	
    	$members = [];
    	$type = '[2]';
		$user_list = User::where('user_type','["2"]')->get();
		$team = Team::findOrfail($id);
		if(!empty($team->member_ids))
		{
			$id  = json_decode($team->member_ids,true);
            if($id != null){
                $members = User::whereIn('id',$id)->where('user_type','["2"]')->get();
                $user_list = User::whereNotIn('id',$id)->where('user_type','["2"]')->get();
                // foreach ($user_list as $key => $value) {
                //     foreach ($value->metas as $mkey => $mvalue) {
                //         dump($mvalue->id);
                //     }
                //    dump($value->metas);
                // }
            }

		}
		
        $plugins = [
                'js' => ['custom'=>['team']]
        ];

    	return view('organization.team.team_info',['members'=> $members ,'team'=>$team , 'employee'=> $user_list, 'plugins'=>$plugins]);
    }
    public function save_info(Request $request)
    {
    	Team::where('id',$request->team_id)->update(['member_ids'=>json_encode($request->id)]);
        return response()->json(['status'=>'success','message'=>'Successfully updated!']);
    	// return redirect()->route('list.team');
    }
    public function editTeam(Request $request)
    {
        $team = $request->except('action','_token');
        $team['member_ids'] = json_encode($request->member_ids);
        $model = Team::where('id',$request->id)->update($team);
        return redirect()->route('list.team');
    }
}
