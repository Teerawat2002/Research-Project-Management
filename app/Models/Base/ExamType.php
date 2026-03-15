<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\ExamSubmission;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamType
 * 
 * @property int $id
 * @property string $name
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|ExamSubmission[] $exam_submissions
 *
 * @package App\Models\Base
 */
class ExamType extends Model
{
	protected $table = 'exam_type';

	public function exam_submissions()
	{
		return $this->hasMany(ExamSubmission::class);
	}
}
