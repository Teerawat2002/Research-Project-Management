<?php

namespace App\Models;

use App\Models\Base\ExamType as BaseExamType;

class ExamType extends BaseExamType
{
	protected $table = 'exam_type';
	
	protected $fillable = [
		'name',
		'status'
	];

	public function exam_submissions()
	{
		return $this->hasMany(ExamSubmission::class);
	}
}
