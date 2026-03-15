<?php

namespace App\Models;

use App\Models\Base\RevisionApproval as BaseRevisionApproval;

class RevisionApproval extends BaseRevisionApproval
{
	protected $table = 'revision_approval';

	protected $fillable = [
		'revision_id',
		'exam_invi_id',
		'status'
	];

	public function revision()
	{
		return $this->belongsTo(Revision::class);
	}

	public function exam_invi_member()
	{
		return $this->belongsTo(ExamInviMember::class, 'exam_invi_id');
	}
}
