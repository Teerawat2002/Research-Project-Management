<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\ExamGrade;
use App\Models\ExamSubmission;
use App\Models\InviGroupMember;
use App\Models\RevisionApproval;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExamInviMember
 * 
 * @property int $id
 * @property int $submission_id
 * @property int $invi_member_id
 * @property string|null $role
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ExamSubmission $exam_submission
 * @property InviGroupMember $invi_group_member
 * @property Collection|ExamGrade[] $exam_grades
 * @property Collection|RevisionApproval[] $revision_approvals
 *
 * @package App\Models\Base
 */
class ExamInviMember extends Model
{
	protected $table = 'exam_invi_member';

	protected $casts = [
		'submission_id' => 'int',
		'invi_member_id' => 'int'
	];

	public function exam_submission()
	{
		return $this->belongsTo(ExamSubmission::class, 'submission_id');
	}

	public function invi_group_member()
	{
		return $this->belongsTo(InviGroupMember::class, 'invi_member_id');
	}

	public function exam_grades()
	{
		return $this->hasMany(ExamGrade::class, 'exam_invi_id');
	}

	public function revision_approvals()
	{
		return $this->hasMany(RevisionApproval::class, 'exam_invi_id');
	}
}
