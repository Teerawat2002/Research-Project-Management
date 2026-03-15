<?php

namespace App\Models;

use App\Models\Base\UploadFile as BaseUploadFile;

class UploadFile extends BaseUploadFile
{
	protected $table = 'upload_file';

	protected $fillable = [
		'fileable_id',
		'fileable_type',
		'cover_file',
		'project_file',
		'abstract_file'
	];

	public function fileable()
	{
		return $this->morphTo();
	}
}
