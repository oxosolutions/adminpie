<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class MediaMeta extends Model
{
    protected $table = 'global_media_meta';
	protected $fillable = ['media_id', 'key', 'value','status'];
}
