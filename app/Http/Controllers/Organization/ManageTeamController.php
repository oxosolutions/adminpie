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

    }
    Public function list()
    {
        $plugins = [
                        'js' => ['select2']
                    ];
    	$team_data = Team::orderBy('id','desc')->get();
    	return view('organization.team.list',['team_data'=>$team_data,'plugins'=>$plugins]);
    }
    public function save(Request $request)
    {
	    $team = 	new Team();
	    $team->fill($request->all());
	    $team->save();
	    return redirect()->route('list.team');
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
                'js' => ['dragula','blockui','custom'=>['team']]
        ];

    	return view('organization.team.team_info',['members'=> $members ,'team'=>$team , 'employee'=> $user_list, 'plugins'=>$plugins]);
    }
    public function save_info(Request $request)
    {
        // dd($request->all());
    	Team::where('id',$request->team_id)->update(['member_ids'=>json_encode($request->id)]);
        return response()->json(['status'=>'success','message'=>'Successfully updated!']);
    	// return redirect()->route('list.team');
    }
}
