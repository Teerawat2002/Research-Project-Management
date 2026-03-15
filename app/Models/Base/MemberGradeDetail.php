<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\GroupMember;
use App\Models\InviGroupMember;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MemberGradeDetail
 * 
 * @property int $id
 * @property int $group_member_id
 * @property int $grader_id
 * @property string|null $grade
 * @property string|null $comment
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property GroupMember $group_member
 * @property InviGroupMember $invi_group_member
 *
 * @package App\Models\Base
 */
class MemberGradeDetail extends Model
{
	protected $table = 'member_grade_detail';

	protected $casts = [
		'group_member_id' => 'int',
		'grader_id' => 'int'
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
