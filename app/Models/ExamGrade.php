<?php

namespace App\Models;

use App\Models\Base\ExamGrade as BaseExamGrade;

class ExamGrade extends BaseExamGrade
{
	protected $table = 'exam_grade';

	protected $fillable = [
		'submission_id',
		'member_id',
		'exam_invi_id',
		'grade',
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
