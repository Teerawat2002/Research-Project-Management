<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Formset;
use App\Models\SubTopic;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MainTopic
 * 
 * @property int $id
 * @property int|null $form_id
 * @property string $name
 * @property string $score
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Formset|null $formset
 * @property Collection|SubTopic[] $sub_topics
 *
 * @package App\Models\Base
 */
class MainTopic extends Model
{
	protected $table = 'main_topics';

	protected $casts = [
		'form_id' => 'int'
	];

	public function formset()
	{
		return $this->belongsTo(Formset::class, 'form_id');
	}

	public function sub_topics()
	{
		return $this->hasMany(SubTopic::class, 'mtopic_id');
	}
}
