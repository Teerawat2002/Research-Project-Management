<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Calendar;
use App\Models\InvigilatorGroup;
use App\Models\ProjectGroup;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AcademicYear
 * 
 * @property int $id
 * @property string $year
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Calendar[] $calendars
 * @property Collection|InvigilatorGroup[] $invigilator_groups
 * @property Collection|ProjectGroup[] $project_groups
 *
 * @package App\Models\Base
 */
class AcademicYear extends Model
{
	protected $table = 'academic_years';

	public function calendars()
	{
		return $this->hasMany(Calendar::class, 'ac_id');
	}

	public function invigilator_groups()
	{
		return $this->hasMany(InvigilatorGroup::class, 'ac_id');
	}

	public function project_groups()
	{
		return $this->hasMany(ProjectGroup::class, 'ac_id');
	}
}
