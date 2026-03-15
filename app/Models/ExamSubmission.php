<?php

namespace App\Models;

use App\Models\Base\ExamSubmission as BaseExamSubmission;

class ExamSubmission extends BaseExamSubmission
{
	protected $fillable = [
		'propose_id',
		'exam_type_id',
		'attempt',
		'file_path',
		'status',
		'comments',
		'e_date',
		'e_time',
		'e_invi_group_id',
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

	public function exam_invi_members()
	{
		return $this->hasMany(ExamInviMember::class, 'submission_id');
	}

	public function exam_submission_histories()
	{
		return $this->hasMany(ExamSubmissionHistory::class);
	}

}
