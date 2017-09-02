<?php

namespace App\Http\Controllers\Organization\cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cms\Media;
use App\Model\Cms\MediaMeta;
use Session;

class MediaController extends Controller
{
    public function index(Request $request)
    {
      $model = Media::all();
    	return view('cms.media.list_media',compact('model'));
    }

    public function create(Request $request){
          if($request->hasFile('file')){
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            $extention = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $mime_type = $file->getMimeType();

              $destinationPath = public_path().'/media';
              $file->move($destinationPath,$fileName);

            $model =  new Media;
            $model->original_name = $fileName;
            $model->type = '';
            $model->extension = $extention;
            $model->mime_type = $mime_type;
            $model->dimension = '';
            $model->size = $size;
            $model->save();
            
            if($model){
              $model = Media::all();
              return view('common.gallery',compact('model'))->render();
            }
          }
    }
    public function gallery(){
      $model = Media::all();
      return view('common.gallery',compact('model'))->render();
    }
    public function getGalleryItem(Request $request)
    {
      $model = Media::where('id',$request->id)->first();
      $modelMeta = MediaMeta::select(['key','value'])->where('media_id',$request->id)->get();
      foreach($modelMeta as $key => $value){
        $model[$value->key] = $value->value;
      }
      return $model;
    }
    public function saveGalleryItem(Request $request)
    {
      $media = Media::where('id',$request->gallery_id)->update(['slug'=>$request->slug]);

      //save rest data in meta
        foreach ($request->except('slug','form_id','form_slug','form_title','title','gallery_id','_token') as $key => $value) {
          $meta = new MediaMeta;
          $meta->media_id = $request->gallery_id;
          $meta->key = $key;
          $meta->value = $value;
          $meta->save();
        }

        return 'true';
    }
}
