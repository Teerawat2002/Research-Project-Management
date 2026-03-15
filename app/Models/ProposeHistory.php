<?php

namespace App\Models;

use App\Models\Base\ProposeHistory as BaseProposeHistory;

class ProposeHistory extends BaseProposeHistory
{
	protected $fillable = [
		'propose_id',
		'status',
		'comments',
		'changed_at'
	];

	// // ความสัมพันธ์กับ Propose
    // public function propose()
    // {
    //     return $this->belongsTo(Propose::class);
    // }
}
