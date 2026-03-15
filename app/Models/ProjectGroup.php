<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectGroup extends Model
{
	protected $table = 'project_groups';

	protected $fillable = ['status', 'ac_id'];

	public function group_members()
	{
		return $this->hasMany(GroupMember::class, 'group_id');
	}

	// public function students()
	// {
	// 	return $this->hasMany(Student::class, 'group_id');
	// }

	public function academic_year()
	{
		return $this->belongsTo(AcademicYear::class, 'ac_id');
	}

	public function alumniProjects()
	{
		return $this->hasMany(AlumniProject::class);
	}
}
