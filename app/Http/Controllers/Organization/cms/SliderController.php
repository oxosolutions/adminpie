<?php

namespace App\Http\Controllers\Organization\cms;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Organization\Cms\Slider\Slider;
use App\Model\Organization\Cms\Slider\SliderMeta;

class SliderController extends Controller
{
    public function index(Request $request)
    {
    	return view('organization.cms.slider.index');
    }
    public function addSlide()
    {
    	return view('organization.cms.slider.slides');
    }
    public function sliderSetting()
    {
    	return view('organization.cms.slider.settings');
    }
}
