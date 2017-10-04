<?php

namespace App\Http\Controllers\Organization\cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Cms\Media;
use App\Model\Organization\Cms\MediaMeta;
use Session;
use Auth;

class MediaController extends Controller
{
    protected function assignModel($model){
        if(Auth::guard('admin')->check()){
            return 'App\\Model\\Admin\\'.$model;
        }else{
            return 'App\\Model\\Organization\\Cms\\'.$model;
        }
    }

    public function index(Request $request)
    {
      $Associate = $this->assignModel('Media');
      $model = $Associate::all();
    	return view('cms.media.list_media',compact('model'));
    }

    public function create(Request $request){
      $Associate = $this->assignModel('Media');

          if($request->hasFile('file')){
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $extention = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $mime_type = $file->getMimeType();

              $destinationPath = public_path().'/media';
              $file->move($destinationPath,$fileName);

            $model =  new $Associate;
            $model->original_name = $fileName;
            $model->type = '';
            $model->extension = $extention;
            $model->mime_type = $mime_type;
            $model->dimension = '';
            $model->size = $size;
            $model->save();
            
            if($model){
              $model = $Associate::all();
              return view('common.gallery',compact('model'))->render();
            }
          }
    }
    public function gallery(){
      $Associate = $this->assignModel('Media');
      $model = $Associate::all();
      return view('common.gallery',compact('model'))->render();
    }
    public function getGalleryItem(Request $request)
    {
      dd($request->all());
      $Associate = $this->assignModel('Media');

      $model = $Associate::where('id',$request->id)->first();
      $MediaMeta = $this->assignModel('MediaMeta');
      $modelMeta = $MediaMeta::select(['key','value'])->where('media_id',$request->id)->get();
      foreach($modelMeta as $key => $value){
        $model[$value->key] = $value->value;
      }
      return $model;
    }
    public function saveGalleryItem(Request $request)
    {
      $Associate = $this->assignModel('Media');
      $media = $Associate::where('id',$request->gallery_id)->update(['slug'=>$request->slug]);

      //save rest data in meta
      $MediaMeta = $this->assignModel('MediaMeta');
        foreach ($request->except('slug','form_id','form_slug','form_title','title','gallery_id','_token') as $key => $value) {
          $meta = new $MediaMeta;
          $meta->media_id = $request->gallery_id;
          $meta->key = $key;
          $meta->value = $value;
          $meta->save();
        }

        return 'true';
    }
    public function updateGalleryInfo(Request $request)
    {
        $data = [];
        foreach(explode('&',$request['request']) as $k => $v){
          $key = strtok($v, '=');
          $value = substr($v, strpos($v, "=") + 1);    
            $data[$key] = $value;
        }
        $Associate = $this->assignModel('Media');
        $media = $Associate::where('id',$data['gallery-id'])->update(['slug'=>$data['slug']]);
        unset($data['slug'] );
        unset($data['title']);
        unset($data['_token']);
        //save rest data in meta
        $MediaMeta = $this->assignModel('MediaMeta');
        foreach ($data as $key => $value) {
          $meta = $MediaMeta::firstOrNew(['media_id'=>$data['gallery-id'],'key'=>$key]);
          $meta->media_id = $data['gallery-id'];
          $meta->key = $key;
          $meta->value = $value;
          $meta->save();
        }
        return 'true';
    }
}
