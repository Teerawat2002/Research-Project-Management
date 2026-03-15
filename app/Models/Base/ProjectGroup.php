<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\AcademicYear;
use App\Models\GroupMember;
use App\Models\Propose;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectGroup
 * 
 * @property int $id
 * @property int|null $ac_id
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property AcademicYear|null $academic_year
 * @property Collection|GroupMember[] $group_members
 * @property Collection|Propose[] $proposes
 *
 * @package App\Models\Base
 */
class ProjectGroup extends Model
{
	protected $table = 'project_groups';

	protected $casts = [
		'ac_id' => 'int'
	];

	public function academic_year()
	{
		return $this->belongsTo(AcademicYear::class, 'ac_id');
	}

	public function group_members()
	{
		return $this->hasMany(GroupMember::class, 'group_id');
	}

	public function proposes()
	{
		return $this->hasMany(Propose::class, 'group_id');
	}
}
