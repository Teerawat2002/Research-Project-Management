<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Revision;
use App\Models\UploadFile;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Upload
 * 
 * @property int $id
 * @property int|null $revision_id
 * @property string $keyword
 * @property string $status
 * @property string|null $comment
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Revision|null $revision
 * @property Collection|UploadFile[] $upload_files
 *
 * @package App\Models\Base
 */
class Upload extends Model
{
	protected $table = 'upload';

	protected $casts = [
		'revision_id' => 'int'
	];

	public function revision()
	{
		return $this->belongsTo(Revision::class);
	}

	public function upload_files()
	{
		return $this->hasMany(UploadFile::class);
	}

	public function latestFile()
	{
		// ใช้ latestOfMany ต้องมีคอลัมน์ id/timestamps บน upload_files
		return $this->hasOne(UploadFile::class)->latestOfMany();
	}
}
