<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UploadFile
 * 
 * @property int $id
 * @property int $upload_id
 * @property string $cover_file
 * @property string $project_file
 * @property string $abstract_file
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Upload $upload
 *
 * @package App\Models\Base
 */
class UploadFile extends Model
{
	protected $table = 'upload_file';

	protected $casts = [
		'upload_id' => 'int'
	];

	public function upload()
	{
		return $this->belongsTo(Upload::class);
	}
}
