<?php

namespace App\Models;

use App\Models\Base\Upload as BaseUpload;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;

class Upload extends BaseUpload
{
	protected $table = 'upload';

	protected $fillable = [
		'revision_id',
		'keyword',
		'status',
		'comment'
	];

	/* =========================
     * Relations
     * ========================= */

	public function revision()
	{
		return $this->belongsTo(Revision::class);
	}

	// ใช้ polymorphic
	public function file(): MorphOne
	{
		return $this->morphOne(UploadFile::class, 'fileable');
	}

	/* =========================
     * Accessors
     * ========================= */

	public function getCoverUrlAttribute(): ?string
	{
		if (!$this->file?->cover_file) {
			return null;
		}

		return asset('storage/' . ltrim($this->file->cover_file, '/'));
	}

	public function getAbstractUrlAttribute(): ?string
	{
		if (!$this->file?->abstract_file) {
			return null;
		}

		return asset('storage/' . ltrim($this->file->abstract_file, '/'));
	}

	public function getProjectUrlAttribute(): ?string
	{
		if (!$this->file?->project_file) {
			return null;
		}

		return asset('storage/' . ltrim($this->file->project_file, '/'));
	}
}
