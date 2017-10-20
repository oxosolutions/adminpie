<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\GlobalGroup as Group;
use App\Model\Group\AdminUsers;
use DB;
use Hash;
use App\Model\Admin\GlobalModule;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('items')){
          $perPage = $request->items;
          if($perPage == 'all'){
            $perPage = 999999999999999;
          }
        }else{
          $perPage = 5;
        }

        $sortedBy = @$request->orderby;
        if($request->has('search')){
            if($sortedBy != ''){
                $model = Group::where('name','like','%'.$request->search.'%')->orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                $model = Group::where('name','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            if($sortedBy != ''){
                $exploded = @explode(':',$sortedBy);
                if(isset($exploded[1])){
                    $sortedBy = $exploded[0];
                }
                $model = Group::orderBy($sortedBy,$request->order)->paginate($perPage);
            }else{
                 $model = Group::orderBy('id','desc')->paginate($perPage);
            }
        }
        $datalist =  [
                        'datalist'=>$model,
                        'showColumns' => ['name'=>'Title','description'=>'Description','created_at'=>'Created At'],
                        'actions' => [
                                        'edit' => ['title'=>'Edit','route'=>'edit.group'],
                                        'delete' => ['title'=>'Delete','route'=>'delete.group'],
                                        // 'delete'=>['title'=>'Delete','route'=>'delete.holiday']
                                     ]
                    ];

        return view('group.group.index' , $datalist); 
        // return view('group.group.index');
    }

    public function create()
    {   
        return view('group.group.create');
    }
    public function store(Request $request)
    {

        $model = new Group;
        $model->fill($request->all('_token','modules','email','password'));
        $model->modules = json_encode($request['modules']);
        $model->save();
        $groupId = $model->id;

        // email apasswor group_id
            $AdminUserData = ['email' => $request['email'] , 'password' => Hash::make($request['password'])];
            $AdminUsers = new AdminUsers;
            $AdminUsers->fill($AdminUserData);
            $AdminUsers->role_id = 1;
            $AdminUsers->group_id = $groupId;
            $AdminUsers->save();


        // // ocrm_{id}_group_users
            DB::statement('CREATE TABLE ocrm_group_'.$groupId.'_users (`id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,`name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,`email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,`password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,`api_token` char(60) COLLATE utf8mb4_unicode_ci NOT NULL,`remember_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,`status` int(11) NULL DEFAULT "0",`created_at` timestamp NULL DEFAULT NULL,`updated_at` timestamp NULL DEFAULT NULL,`deleted_at` int(11) DEFAULT "0",`app_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL)');
            /*DB::statement('CREATE TABLE ocrm_group_'.$groupId.'_user_mapping (id INT(11) AUTO_INCREMENT PRIMARY KEY, user_id INT(11) UNSIGNED NOT NULL, organization_id INT(11) UNSIGNED NOT NULL, role_id INT(11), created_at timestamp, updated_at timestamp)');*/
            DB::statement('CREATE TABLE ocrm_group_'.$groupId.'_user_meta ( `id` INT(50) NOT NULL AUTO_INCREMENT , `user_id` INT(50) UNSIGNED NOT NULL , `key` VARCHAR(255) NOT NULL , `value` VARCHAR(255) NOT NULL , `created_at` TIMESTAMP NOT NULL , `updated_at` TIMESTAMP NOT NULL , PRIMARY KEY (`id`))');
            return redirect()->route('list.group');
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
    {   $group_data = Group::findOrFail($id);
       
        $modules = GlobalModule::pluck('name','id');
        
        return view('group.group.edit',['group_data'=>$group_data,'modules'=> $modules ]);
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
        $model = Group::find($id);
        $model->fill($request->all('_token','modules','email','password'));
        $model->modules = json_encode($request['modules']);
        $model->save();
        return redirect()->route('list.group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
        /*try{
            DB::beginTransaction();
            $model = ORG::findOrFail($id);
            $model->delete();

            $data =   DB::select("select CONCAT('DROP TABLE `',t.table_schema,'`.`',t.table_name,'`;') AS dropTable
                      FROM information_schema.tables t
                      WHERE t.table_schema = '".env('DB_DATABASE', 'forge')."'
                      AND t.table_name LIKE 'ocrm_".$id."%' 
                      ORDER BY t.table_name");
            foreach ($data as $key => $value) {
                 DB::select($value->dropTable);
              }
                      DB::commit();

        Session::flash('success','Successfully deleted!');
        }catch(\Exception $e){
          // throw $e;
            DB::rollback();
            Session::flash('error','Somthing goes wrong Try again.');
        }
        return redirect()->route('list.organizations');*/
    }
}
