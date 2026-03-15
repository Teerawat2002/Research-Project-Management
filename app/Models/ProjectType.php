<?php

namespace App\Models;

use App\Models\Base\ProjectType as BaseProjectType;

class ProjectType extends BaseProjectType
{
	protected $table = 'project_type';

	protected $fillable = [
		'name'
	];

	public function examinations()
	{
		return $this->hasMany(Examination::class, 'type_id');
	}

	public function formsets()
	{
		return $this->hasMany(Formset::class, 'exam_type_id');
	}

	public function proposes()
	{
		return $this->hasMany(Propose::class, 'type_id');
	}
}
