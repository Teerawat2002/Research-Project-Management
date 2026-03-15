<?php

namespace App\Models;

use App\Models\Base\ExamInviMember as BaseExamInviMember;

class ExamInviMember extends BaseExamInviMember
{
	protected $table = 'exam_invi_member';

	protected $fillable = [
		'submission_id',
		'invi_member_id',
		'role',
	];

	public function exam_submission()
	{
		return $this->belongsTo(ExamSubmission::class, 'submission_id');
	}

	public function invi_group_member()
	{
		return $this->belongsTo(InviGroupMember::class, 'invi_member_id');
	}

}
