<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\ExamSubmission;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamSubmissionHistory
 * 
 * @property int $id
 * @property int $exam_submission_id
 * @property string $status
 * @property string|null $comments
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ExamSubmission $exam_submission
 *
 * @package App\Models\Base
 */
class ExamSubmissionHistory extends Model
{
	protected $table = 'exam_submission_histories';

	protected $casts = [
		'exam_submission_id' => 'int'
	];

	public function exam_submission()
	{
		return $this->belongsTo(ExamSubmission::class);
	}
}
