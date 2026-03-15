<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = ['year'];

    public function calendars()
	{
		return $this->hasMany(Calendar::class, 'ac_id');
	}

	public function students()
	{
		return $this->hasMany(Student::class, 'ac_id');
	}

	public function project_groups()
	{
		return $this->hasMany(ProjectGroup::class, 'ac_id');
	}
}
