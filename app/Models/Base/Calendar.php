<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models\Base;

use App\Models\AcademicYear;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Calendar
 * 
 * @property int $id
 * @property int $ac_id
 * @property Carbon $start_date
 * @property Carbon $end_date
 * @property string $title
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property AcademicYear $academic_year
 *
 * @package App\Models\Base
 */
class Calendar extends Model
{
	protected $table = 'calendar';

	protected $casts = [
		'ac_id' => 'int',
		'start_date' => 'datetime',
		'end_date' => 'datetime'
	];

	public function academic_year()
	{
		return $this->belongsTo(AcademicYear::class, 'ac_id');
	}
}
