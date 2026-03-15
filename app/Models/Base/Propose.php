<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Advisor;
use App\Models\ExamSubmission;
use App\Models\ProjectGroup;
use App\Models\ProjectType;
use App\Models\ProposeHistory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Propose
 * 
 * @property int $id
 * @property string $title
 * @property string $objective
 * @property string $scope
 * @property string|null $tools
 * @property int|null $group_id
 * @property int|null $type_id
 * @property string $status
 * @property string|null $comments
 * @property int|null $a_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ProjectGroup|null $project_group
 * @property Advisor|null $advisor
 * @property ProjectType|null $project_type
 * @property Collection|ExamSubmission[] $exam_submissions
 * @property Collection|ProposeHistory[] $propose_histories
 *
 * @package App\Models\Base
 */
class Propose extends Model
{
	protected $table = 'proposes';

	protected $casts = [
		'group_id' => 'int',
		'type_id' => 'int',
		'a_id' => 'int'
	];

	public function project_group()
	{
		return $this->belongsTo(ProjectGroup::class, 'group_id');
	}

	public function advisor()
	{
		return $this->belongsTo(Advisor::class, 'a_id');
	}

	public function project_type()
	{
		return $this->belongsTo(ProjectType::class, 'type_id');
	}

	public function exam_submissions()
	{
		return $this->hasMany(ExamSubmission::class);
	}

	public function propose_histories()
	{
		return $this->hasMany(ProposeHistory::class);
	}
}
