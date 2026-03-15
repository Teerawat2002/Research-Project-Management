<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\ExamInviMember;
use App\Models\ExamSubmission;
use App\Models\GroupMember;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamGrade
 * 
 * @property int $id
 * @property int $submission_id
 * @property int $member_id
 * @property int $exam_invi_id
 * @property string $grade
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ExamSubmission $exam_submission
 * @property GroupMember $group_member
 * @property ExamInviMember $exam_invi_member
 *
 * @package App\Models\Base
 */
class ExamGrade extends Model
{
	protected $table = 'exam_grade';

	protected $casts = [
		'submission_id' => 'int',
		'member_id' => 'int',
		'exam_invi_id' => 'int'
	];

	public function exam_submission()
	{
		return $this->belongsTo(ExamSubmission::class, 'submission_id');
	}

	public function group_member()
	{
		return $this->belongsTo(GroupMember::class, 'member_id');
	}

	public function exam_invi_member()
	{
		return $this->belongsTo(ExamInviMember::class, 'exam_invi_id');
	}
}
