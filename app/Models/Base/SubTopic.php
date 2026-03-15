<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\MainTopic;
use App\Models\SubsubTopic;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubTopic
 * 
 * @property int $id
 * @property int $mtopic_id
 * @property string $name
 * @property string $score
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property MainTopic $main_topic
 * @property Collection|SubsubTopic[] $subsub_topics
 *
 * @package App\Models\Base
 */
class SubTopic extends Model
{
	protected $table = 'sub_topics';

	protected $casts = [
		'mtopic_id' => 'int'
	];

	public function main_topic()
	{
		return $this->belongsTo(MainTopic::class, 'mtopic_id');
	}

	public function subsub_topics()
	{
		return $this->hasMany(SubsubTopic::class, 'stopic_id');
	}
}
