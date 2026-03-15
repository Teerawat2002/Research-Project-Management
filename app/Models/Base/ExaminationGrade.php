<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\GroupMember;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExaminationGrade
 * 
 * @property int $id
 * @property int $examination_id
 * @property int $group_member_id
 * @property int $evaluator_id
 * @property string $evaluator_type
 * @property string $grade
 * @property Carbon $grade_date
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property GroupMember $group_member
 *
 * @package App\Models\Base
 */
class ExaminationGrade extends Model
{
	protected $table = 'examination_grades';

	protected $casts = [
		'examination_id' => 'int',
		'group_member_id' => 'int',
		'evaluator_id' => 'int',
		'grade_date' => 'datetime'
	];

	public function group_member()
	{
		return $this->belongsTo(GroupMember::class);
	}
}
