<?php

namespace App\Http\Controllers\Organization\cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Cms\Slider\Slider;
use App\Model\Organization\Cms\Slider\SliderMeta;
use Session;

class SliderController extends Controller
{
    public function index(Request $request)
    {
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
                $model = Slider::where('name','like','%'.$request->search.'%')->paginate($perPage);
            }else{
                $model = Slider::where('name','like','%'.$request->search.'%')->paginate($perPage);
            }
        }else{
            $model = Slider::paginate($perPage);
        }
        // if(Auth::guard('admin')->check() == true){
        //   $edit = 'admin.edit.menu';
        //   $delete = 'admin.delete.menu';
        // }else{
        //   $edit = 'edit.menu';
        //   $delete = 'delete.menu';
        // }
        $datalist =  [
                        'datalist'    => $model,
                        'showColumns' => ['name'=>'Name','description'=>'Description' ,'created_at'=>'Created'],
                        'actions'     => [
                                            'edit' => ['title'=>'Edit','route'=>'slider.edit'],
                                            'option' => ['title'=>'Options','route'=>'options.slider'],
                                            'delete'=>['title'=>'Delete','route'=>'delete.slider']
                                         ]
                    ];
        return view('organization.cms.slider.index', $datalist);
    }

        
    public function addSlide()
    {
        return view('organization.cms.slider.slides');
    }
    public function saveSlider(Request $request)
    {
        // $destination_path = upload_path('slides');
        // $sliderData = $request->all();
        // foreach($sliderData['slider'] as $k => $v){
        //     $new_filename = $v['file']->getClientOriginalName();
        //     $uploadFile = $v['file']->move($destination_path, $new_filename);
        //     $sliderData['slider'][$k]['file'] = $new_filename;             
        // }
        $table = Session::get('organization_id').'_sliders';
        $rules = [
                    'slug' => 'required|unique:'.$table,
                    'name' => 'required'
                    ];
        $this->validate($request,$rules);

        $output = parse_slug($request->slug);
        $request['slug'] = $output;

        $model = new Slider;
        $model->name =  $request->name;
        $model->description = $request->description;
        $model->slug = $request->slug;
        $model->slider = json_encode($request->slider);
        $model->save();
        return redirect()->route('list.sliders');
    }
    public function sliderEdit($id)
    {
        $model = Slider::find($id);
        return view('organization.cms.slider.edit',compact('model'));
    }
    public function sliderUpdate(Request $request)
    {
        $destination_path = upload_path('slides');
        $sliderData = $request->all();
        // foreach($sliderData['slider'] as $k => $v){
        //     $new_filename = $v['file']->getClientOriginalName();
        //     $uploadFile = $v['file']->move($destination_path, $new_filename);
        //     $sliderData['slider'][$k]['file'] = $new_filename;             
        // }
        $table = Session::get('organization_id').'_sliders';
        $rules = [
                    'slug' => 'required|unique:'.$table,
                    'title' => 'required'
                ];
        
        $output = parse_slug($request->slug);
        $request['slug'] = $output;
        $checkSlug = Slider::where('id',$request['slider_id'])->first();
        if($checkSlug->slug != $request->slug){
            $this->validate($request,$rules); 
        }

        $model = Slider::firstOrNew(['id' => $request['slider_id']]);
        $model->name =  $request->name;
        $model->description = $request->description;
        $model->slug = $request->slug;
        $model->slider = json_encode($request->slider);
        $model->save();
        return back();

    }
    public function deleteSlider($id)
    {
        $model = Slider::where('id',$id)->delete();
        return back();
    }
    public function sliderOptions($id)
    {   
        $options = Slider::where('id',$id)->first();
        $optionsData = json_decode($options->options , true);
        return view('organization.cms.slider.options',compact('optionsData'));
    }
    public function saveSliderOptions(Request $request)
    {
        $model = Slider::where('id',$request['slider_id'])->update(['options' => json_encode($request->except('_token','slider_id') ,true)]);
        
        return back();
    }
    public function saveSliderSettings(Request $request)
    {
        $model = Slider::where('id',$request['slider_id'])->update(['setting' => json_encode($request->except('_token','slider_id') ,true)]);
        return back();
    }
}
