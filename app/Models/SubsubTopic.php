<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubsubTopic extends Model
{
    protected $table = 'subsub_topics';

    protected $fillable = ['name', 'score', 'stopic_id'];

	public function sub_topic()
	{
		return $this->belongsTo(SubTopic::class, 'stopic_id');
	}
}
