<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\AcademicYear;
use App\Models\ExamSubmission;
use App\Models\InviGroupMember;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InvigilatorGroup
 * 
 * @property int $id
 * @property string $name
 * @property int $ac_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property AcademicYear $academic_year
 * @property Collection|ExamSubmission[] $exam_submissions
 * @property Collection|InviGroupMember[] $invi_group_members
 *
 * @package App\Models\Base
 */
class InvigilatorGroup extends Model
{
	protected $table = 'invigilator_group';

	protected $casts = [
		'ac_id' => 'int'
	];

	public function academic_year()
	{
		return $this->belongsTo(AcademicYear::class, 'ac_id');
	}

	public function exam_submissions()
	{
		return $this->hasMany(ExamSubmission::class, 'e_invi_group_id');
	}

	public function invi_group_members()
	{
		return $this->hasMany(InviGroupMember::class, 'invi_group_id');
	}
}
