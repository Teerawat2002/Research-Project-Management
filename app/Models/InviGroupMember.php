<?php

namespace App\Models;

use App\Models\Base\InviGroupMember as BaseInviGroupMember;

class InviGroupMember extends BaseInviGroupMember
{
	protected $fillable = [
		'invi_group_id',
		'a_id'
	];

	public function invigilator_group()
	{
		return $this->belongsTo(InvigilatorGroup::class, 'invi_group_id');
	}

	public function advisor()
	{
		return $this->belongsTo(Advisor::class, 'a_id');
	}

	public function exam_invi_members()
	{
		return $this->hasMany(ExamInviMember::class, 'invi_member_id');
	}

	// public function member_grade_details()
	// {
	// 	return $this->hasMany(MemberGradeDetail::class, 'grader_id');
	// }
}
