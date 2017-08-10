<?php
namespace App\Helpers;
use App\Model\Admin\FormBuilder as Fields;
use App\Model\Admin\forms as Forms;
use App\Model\Admin\section as Section;

use App\Model\Organization\FormBuilder as OrgFields;
use App\Model\Organization\forms as OrgForms;
use App\Model\Organization\section as OrgSection;
use DB;
class FormGenerator{

	/**
	 * will generate the form according to the slug
	 * @param [string] $form_slug 
	 */
	public static function GenerateForm($form_slug, Array $Options = [], $dataModel = null, $formFrom = 'admin'){
		$model = '';
		if($formFrom == 'admin'){
			$model = 'App\\Model\\Admin\\forms';
		}else{
			$model = 'App\\Model\\Organization\\forms';
		}
		$FormDetails = $model::where('form_slug',$form_slug)->with(['section'=>function($query){

			return $query->with(['fields'=>function($query){

				return $query->with('fieldMeta');

			},'sectionMeta']);

		},'formsMeta'])->first();
		if($FormDetails != null){
			$HTMLContent = self::GetHTMLForm($FormDetails, $Options, $formFrom, $dataModel);
			return $HTMLContent;
		}else{
			dd('No form found!');
		}
	}

	/**
	 * This function will return the filed according to its slug
	 * @param [string] $field_slug 
	 */
	public static function GenerateField($field_slug, Array $Options = [], $dataModel = null, $formFrom = 'admin'){
		$model = '';
		if($formFrom == 'admin'){
			$model = 'App\\Model\\Admin\\FormBuilder';
		}else{
			$model = 'App\\Model\\Organization\\FormBuilder';
		}
		$FieldsCollection = $model::where('field_slug',$field_slug)->with(['fieldMeta'])->first();
		if($FieldsCollection != null){
			$HTMLField = self::GetHTMLField($FieldsCollection->field_type, $FieldsCollection, $Options, $dataModel);
			
			return $HTMLField;
		}else{
			dd('No field found');
		}
	}

	/**
	 * [GenerateSection description]
	 * @param [type]      $section_slug [description]
	 * @param Array|array $Options      [description]
	 */
	public static function GenerateSection($section_slug, Array $Options = [], $datamodel = null, $formFrom = 'admin'){
		$model = '';
		if($formFrom == 'admin'){
			$model = 'App\\Model\\Admin\\section';
		}else{
			$model = 'App\\Model\\Organization\\section';
		}
		$SectionCollection = $model::where('section_slug',$section_slug)->with(['sectionMeta','fields'])->first();
		if($SectionCollection == null){
			dd('No section found');
		}
		$sectionType = self::GetMetaValue($SectionCollection->sectionMeta,'section_type');
		if($sectionType == 'Repeater'){
			$Options['field_type'] = 'array';
			$HTMLContent = self::GetHTMLGroup($SectionCollection, $Options, $datamodel, $formFrom);
		}else{
			$HTMLContent = self::GetHTMLSection($SectionCollection, $Options, $datamodel, $formFrom);
		}
		return $HTMLContent;
	}

	/**
	 * [GetHTMLSection description]
	 * @param [type] $collection [description]
	 */
	public static function GetHTMLSection($collection, $Options, $model, $formFrom){
		return view('common.form.section',['collection'=>$collection,'options'=>$Options,'formFrom'=>$formFrom,'model'=>$model])->render();
	}

	/**
	 * [GetHTMLGroup description]
	 * @param [type] $collection [description]
	 * @param [type] $Options    [description]
	 */
	public static function GetHTMLGroup($collection, $Options, $model, $formFrom){
		return view('common.form.group',['collection'=>$collection,'options'=>$Options,'model'=>$model,'formFrom'=>$formFrom])->render();
	}

	/**
	 * [GetHTMLField description]
	 * @param [type] $field      [description]
	 * @param [type] $collection [description]
	 * @param [type] $Options    [description]
	 */
	public static function GetHTMLField($field, $collection, $Options, $model){

		return view('common.form.fields.'.$field,['collection'=>$collection,'options'=>$Options,'model'=>$model])->render();
	}


	/**
	 * Will render the html content for form template
	 * @param [form object] $collection have all data and realtions of form
	 */
	public static function GetHTMLForm($collection, $options, $formFrom, $model){

		return view('common.form.form',['collection'=>$collection, 'options'=>$options, 'formFrom'=>$formFrom,'model'=>$model])->render();
	}

	public static function GetMetaValue($metaCollection, $metaKey){
		$metaData = $metaCollection->where('key',$metaKey);
		$metaValue = false;
		foreach($metaData as $key => $value){
			$metaValue = $value->value;
		}
		return $metaValue;
	}

	public static function GetSectionFieldsName($section_slug, $formFrom = 'admin'){
		$SectionCollection = Section::where('section_slug',$section_slug)->with(['sectionMeta','fields'])->first();
		$fields = [];
		foreach($SectionCollection->fields as $key =>  $field){
			$fields[] = $field->field_title;
		}
		return $fields;
	}

}