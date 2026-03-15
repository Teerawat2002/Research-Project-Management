<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\SubTopic;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubsubTopic
 * 
 * @property int $id
 * @property int $stopic_id
 * @property string $name
 * @property string $score
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property SubTopic $sub_topic
 *
 * @package App\Models\Base
 */
class SubsubTopic extends Model
{
	protected $table = 'subsub_topics';

	protected $casts = [
		'stopic_id' => 'int'
	];

	public function sub_topic()
	{
		return $this->belongsTo(SubTopic::class, 'stopic_id');
	}
}
