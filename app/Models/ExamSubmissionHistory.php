<?php

namespace App\Models;

use App\Models\Base\ExamSubmissionHistory as BaseExamSubmissionHistory;

class ExamSubmissionHistory extends BaseExamSubmissionHistory
{
	protected $table = 'exam_submission_histories';

	protected $fillable = [
		'exam_submission_id',
		'status',
		'comments',
		'changed_at'
	];

	public function exam_submission()
	{
		return $this->belongsTo(ExamSubmission::class);
	}
}
