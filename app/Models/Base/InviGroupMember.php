<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Advisor;
use App\Models\ExamInviMember;
use App\Models\InvigilatorGroup;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class InviGroupMember
 * 
 * @property int $id
 * @property int $invi_group_id
 * @property int $a_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property InvigilatorGroup $invigilator_group
 * @property Advisor $advisor
 * @property Collection|ExamInviMember[] $exam_invi_members
 *
 * @package App\Models\Base
 */
class InviGroupMember extends Model
{
	protected $table = 'invi_group_member';

	protected $casts = [
		'invi_group_id' => 'int',
		'a_id' => 'int'
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
}
