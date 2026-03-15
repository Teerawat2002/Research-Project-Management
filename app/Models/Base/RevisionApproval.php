<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\ExamInviMember;
use App\Models\Revision;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class RevisionApproval
 * 
 * @property int $id
 * @property int $revision_id
 * @property int $exam_invi_id
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Revision $revision
 * @property ExamInviMember $exam_invi_member
 *
 * @package App\Models\Base
 */
class RevisionApproval extends Model
{
	protected $table = 'revision_approval';

	protected $casts = [
		'revision_id' => 'int',
		'exam_invi_id' => 'int'
	];

	public function revision()
	{
		return $this->belongsTo(Revision::class);
	}

	public function exam_invi_member()
	{
		return $this->belongsTo(ExamInviMember::class, 'exam_invi_id');
	}
}
