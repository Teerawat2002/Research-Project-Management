<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\GroupMember;
use App\Models\Major;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Student
 * 
 * @property int $id
 * @property int $s_id
 * @property string $s_fname
 * @property string $s_lname
 * @property string $s_password
 * @property string $status
 * @property int $m_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Major $major
 * @property Collection|GroupMember[] $group_members
 *
 * @package App\Models\Base
 */
class Student extends Model
{
	protected $table = 'students';

	protected $casts = [
		's_id' => 'int',
		'm_id' => 'int'
	];

	public function major()
	{
		return $this->belongsTo(Major::class, 'm_id');
	}

	public function group_members()
	{
		return $this->hasMany(GroupMember::class, 's_id');
	}
}
