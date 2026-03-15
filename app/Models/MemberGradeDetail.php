<?php

namespace App\Models;

use App\Models\Base\MemberGradeDetail as BaseMemberGradeDetail;

class MemberGradeDetail extends BaseMemberGradeDetail
{
	protected $table = 'member_grade_detail';

	protected $fillable = [
		'group_member_id',
		'grader_id',
		'grade',
		'comment'
	];

	public function group_member()
	{
		return $this->belongsTo(GroupMember::class);
	}

	public function invi_group_member()
	{
		return $this->belongsTo(InviGroupMember::class, 'grader_id');
	}
}
