<?php

namespace App\Models;

use App\Models\Base\Upload as BaseUpload;

class Upload extends BaseUpload
{
	protected $table = 'upload';

	protected $fillable = [
		'revision_id',
		'keyword',
		'status',
		'comment'
	];

	public function revision()
	{
		return $this->belongsTo(Revision::class);
	}

	public function upload_files()
	{
		return $this->hasMany(UploadFile::class);
	}

	public function files()
	{
		return $this->morphMany(UploadFile::class, 'fileable');
	}

	public function latestFile()
	{
		return $this->hasOne(UploadFile::class, 'upload_id')->latestOfMany('id');
		// หรือ ->latestOfMany('created_at')
	}

	public function getCoverUrlAttribute()
	{
		if (!$this->latestFile || !$this->latestFile->cover_file) {
			return null;
		}

		$path = str_replace('\\', '/', $this->latestFile->cover_file);
		$full = public_path('storage/' . ltrim($path, '/'));

		return file_exists($full)
			? asset('storage/' . ltrim($path, '/'))
			: null;
	}
}
