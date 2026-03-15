<?php

namespace App\Models;

use App\Models\Base\InvigilatorGroup as BaseInvigilatorGroup;

class InvigilatorGroup extends BaseInvigilatorGroup
{
	protected $fillable = [
		'name',
		'ac_id'
	];

	public function academic_year()
	{
		return $this->belongsTo(AcademicYear::class, 'ac_id');
	}

	public function invi_group_members()
	{
		return $this->hasMany(InviGroupMember::class, 'invi_group_id');
	}
}
