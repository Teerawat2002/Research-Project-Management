<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\ExamSubmission;
use App\Models\ExaminationGrade;
use App\Models\InvigilatorGroup;
use App\Models\Revision;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Examination
 * 
 * @property int $id
 * @property int $submission_id
 * @property string|null $room
 * @property Carbon|null $date
 * @property Carbon|null $time
 * @property int|null $inv_group_id
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ExamSubmission $exam_submission
 * @property InvigilatorGroup|null $invigilator_group
 * @property Collection|ExaminationGrade[] $examination_grades
 * @property Collection|Revision[] $revisions
 *
 * @package App\Models\Base
 */
class Examination extends Model
{
	protected $table = 'examination';

	protected $casts = [
		'submission_id' => 'int',
		'date' => 'datetime',
		'time' => 'datetime',
		'inv_group_id' => 'int'
	];

	public function exam_submission()
	{
		return $this->belongsTo(ExamSubmission::class, 'submission_id');
	}

	public function invigilator_group()
	{
		return $this->belongsTo(InvigilatorGroup::class, 'inv_group_id');
	}

	public function examination_grades()
	{
		return $this->hasMany(ExaminationGrade::class);
	}

	public function revisions()
	{
		return $this->hasMany(Revision::class, 'exam_id');
	}
}
