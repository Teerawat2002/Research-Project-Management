<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\ExamGrade;
use App\Models\ExamInviMember;
use App\Models\ExamSubmissionHistory;
use App\Models\ExamType;
use App\Models\InvigilatorGroup;
use App\Models\Propose;
use App\Models\Revision;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamSubmission
 * 
 * @property int $id
 * @property int $propose_id
 * @property int $exam_type_id
 * @property int|null $attempt
 * @property string|null $file_path
 * @property string $status
 * @property string|null $comments
 * @property string|null $e_room
 * @property Carbon|null $e_date
 * @property Carbon|null $e_time
 * @property int|null $e_invi_group_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Propose $propose
 * @property ExamType $exam_type
 * @property InvigilatorGroup|null $invigilator_group
 * @property Collection|ExamGrade[] $exam_grades
 * @property Collection|ExamInviMember[] $exam_invi_members
 * @property Collection|ExamSubmissionHistory[] $exam_submission_histories
 * @property Collection|Revision[] $revisions
 *
 * @package App\Models\Base
 */
class ExamSubmission extends Model
{
	protected $table = 'exam_submissions';

	protected $casts = [
		'propose_id' => 'int',
		'exam_type_id' => 'int',
		'attempt' => 'int',
		'e_date' => 'datetime',
		'e_time' => 'datetime',
		'e_invi_group_id' => 'int'
	];

	public function propose()
	{
		return $this->belongsTo(Propose::class);
	}

	public function exam_type()
	{
		return $this->belongsTo(ExamType::class);
	}

	public function invigilator_group()
	{
		return $this->belongsTo(InvigilatorGroup::class, 'e_invi_group_id');
	}

	public function exam_grades()
	{
		return $this->hasMany(ExamGrade::class, 'submission_id');
	}

	public function exam_invi_members()
	{
		return $this->hasMany(ExamInviMember::class, 'submission_id');
	}

	public function exam_submission_histories()
	{
		return $this->hasMany(ExamSubmissionHistory::class);
	}

	public function revisions()
	{
		return $this->hasMany(Revision::class, 'submission_id');
	}
}
