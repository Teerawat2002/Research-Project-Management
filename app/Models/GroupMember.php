<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    protected $table = 'group_members';

	protected $fillable = ['group_id', 's_id', 'grade'];


	public function project_group()
	{
		return $this->belongsTo(ProjectGroup::class, 'group_id');
	}

	public function student()
	{
		return $this->belongsTo(Student::class, 's_id');
	}

	// public function member_grade_details()
	// {
	// 	return $this->hasMany(MemberGradeDetail::class);
	// }
}
