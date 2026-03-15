<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\Propose;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProposeHistory
 * 
 * @property int $id
 * @property int $propose_id
 * @property string $status
 * @property string|null $comments
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Propose $propose
 *
 * @package App\Models\Base
 */
class ProposeHistory extends Model
{
	protected $table = 'propose_histories';

	protected $casts = [
		'propose_id' => 'int'
	];

	public function propose()
	{
		return $this->belongsTo(Propose::class);
	}
}
