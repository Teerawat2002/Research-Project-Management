<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\ExamSubmission;
use App\Models\RevisionApproval;
use App\Models\Upload;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Revision
 * 
 * @property int $id
 * @property int $submission_id
 * @property string $file_path
 * @property string|null $edit_detail
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ExamSubmission $exam_submission
 * @property Collection|RevisionApproval[] $revision_approvals
 * @property Collection|Upload[] $uploads
 *
 * @package App\Models\Base
 */
class Revision extends Model
{
	protected $table = 'revision';

	protected $casts = [
		'submission_id' => 'int'
	];

	public function exam_submission()
	{
		return $this->belongsTo(ExamSubmission::class, 'submission_id');
	}

	public function revision_approvals()
	{
		return $this->hasMany(RevisionApproval::class);
	}

	public function uploads()
	{
		return $this->hasMany(Upload::class);
	}
}
