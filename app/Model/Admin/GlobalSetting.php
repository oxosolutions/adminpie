<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class GlobalSetting extends Model
{
    protected $fillable = ['key', 'value'];


    public static function getModelsAssocList(){
        $model = self::where(['key'=>'model_associate'])->first();
        $assocList = [];
        if($model != null){
            $assocList = json_decode($model->value,true);
        }
        $listArray = [];
        foreach($assocList as $key => $value){
            $explodedModel = explode('\\',$value['model_associate']);
            $explodeMethod = explode('@',$explodedModel[3]);
            $listArray[$value['model_associate']] = $explodedModel[2].' > '.$explodeMethod[0].' > '.$explodeMethod[1];
        }
        return $listArray;

    }
}
