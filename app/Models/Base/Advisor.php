<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\InviGroupMember;
use App\Models\Major;
use App\Models\Propose;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Advisor
 * 
 * @property int $id
 * @property int $a_id
 * @property string $a_fname
 * @property string $a_lname
 * @property string $a_password
 * @property string $status
 * @property string $a_type
 * @property int $m_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Major $major
 * @property Collection|InviGroupMember[] $invi_group_members
 * @property Collection|Propose[] $proposes
 *
 * @package App\Models\Base
 */
class Advisor extends Model
{
	protected $table = 'advisors';

	protected $casts = [
		'a_id' => 'int',
		'm_id' => 'int'
	];

	public function major()
	{
		return $this->belongsTo(Major::class, 'm_id');
	}

	public function invi_group_members()
	{
		return $this->hasMany(InviGroupMember::class, 'a_id');
	}

	public function proposes()
	{
		return $this->hasMany(Propose::class, 'a_id');
	}
}
