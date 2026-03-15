<?php

namespace App\Models;

use App\Models\Base\Calendar as BaseCalendar;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Calendar extends BaseCalendar
{
	use HasFactory;

	protected $table = 'calendar';

	protected $fillable = [
		'ac_id',
		'start_date',
		'end_date',
		'title',
		'description'
	];

	public function academic_year()
	{
		return $this->belongsTo(AcademicYear::class, 'ac_id', 'id');
	}

}
