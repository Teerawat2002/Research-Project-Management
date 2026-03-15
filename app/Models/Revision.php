<?php

namespace App\Models;

use App\Models\Base\Revision as BaseRevision;

class Revision extends BaseRevision
{
	protected $table = 'revision';

	protected $fillable = [
		'submission_id',
		'file_path',
		'edit_detail',
		'status',
	];

	public function exam_submission()
	{
		return $this->belongsTo(ExamSubmission::class, 'submission_id');
	}

	public function revision_approvals()
	{
		return $this->hasMany(RevisionApproval::class);
	}

	/**
	 * Approval record ของ invigilator คนที่โหลด relation นี้
	 */
	// public function myApproval()
	// {
	// 	return $this->hasOne(RevisionApproval::class, 'revision_id')
	// 		->where('exam_invi_id', request()->get('exam_invi_id'));
	// }

	public function myApproval()
	{
		return $this->hasOne(RevisionApproval::class, 'revision_id');
	}
	
	public function uploads()
	{
		return $this->hasMany(Upload::class);
	}
}
