<?php
namespace App\Helpers;
use App\Model\Admin\FormBuilder as Fields;
use App\Model\Admin\forms as Forms;
use App\Model\Admin\section as Section;
class FormGenerator{

	/**
	 * will generate the form according to the slug
	 * @param [string] $form_slug 
	 */
	public static function GenerateForm($form_slug){
		$FormDetails = Forms::where('form_slug',$form_slug)->with(['section'=>function($query){

			return $query->with(['fields'=>function($query){

				return $query->with('fieldMeta');

			},'sectionMeta']);

		},'formsMeta'])->first();
		if($FormDetails != null){
			$HTMLContent = self::GetHTMLForm($FormDetails);
			return $HTMLContent;
		}else{
			dd('No form found!');
		}
	}

	/**
	 * This function will return the filed according to its slug
	 * @param [string] $field_slug 
	 */
	public static function GenerateField($field_slug, Array $Options = []){
		
		$FieldsCollection = Fields::where('field_slug',$field_slug)->with(['fieldMeta'])->first();
		
		$HTMLField = self::GetHTMLField($FieldsCollection->field_type, $FieldsCollection, $Options);
			
		return $HTMLField;
	}

	/**
	 * [GenerateSection description]
	 * @param [type]      $section_slug [description]
	 * @param Array|array $Options      [description]
	 */
	public static function GenerateSection($section_slug, Array $Options = []){

		$SectionCollection = Section::where('section_slug',$section_slug)->with(['sectionMeta','fields'])->first();
		$sectionType = self::GetMetaValue($SectionCollection->sectionMeta,'section_type');
		if($sectionType == 'Repeater'){
			$HTMLContent = self::GetHTMLGroup($SectionCollection, $Options);
		}else{
			$HTMLContent = self::GetHTMLSection($SectionCollection, $Options);
		}
		return $HTMLContent;
	}

	/**
	 * [GetHTMLSection description]
	 * @param [type] $collection [description]
	 */
	public static function GetHTMLSection($collection, $Options){
		return view('common.form.section',['collection'=>$collection,'options'=>$Options])->render();
	}

	/**
	 * [GetHTMLGroup description]
	 * @param [type] $collection [description]
	 * @param [type] $Options    [description]
	 */
	public static function GetHTMLGroup($collection, $Options){
		return view('common.form.group',['collection'=>$collection,'options'=>$Options])->render();
	}

	/**
	 * [GetHTMLField description]
	 * @param [type] $field      [description]
	 * @param [type] $collection [description]
	 * @param [type] $Options    [description]
	 */
	public static function GetHTMLField($field, $collection, $Options){

		return view('common.form.fields.'.$field,['collection'=>$collection,'options'=>$Options])->render();
	}


	/**
	 * Will render the html content for form template
	 * @param [form object] $collection have all data and realtions of form
	 */
	public static function GetHTMLForm($collection){

		return view('common.form.form',['collection'=>$collection])->render();
	}

	public static function GetMetaValue($metaCollection, $metaKey){
		$metaData = $metaCollection->where('key',$metaKey);
		$metaValue = false;
		foreach($metaData as $key => $value){
			$metaValue = $value->value;
		}
		return $metaValue;
	}

}