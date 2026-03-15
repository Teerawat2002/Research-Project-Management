<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubTopic extends Model
{
    protected $table = 'sub_topics';

    protected $fillable = ['name', 'score', 'mtopic_id'];

	public function main_topic()
	{
		return $this->belongsTo(MainTopic::class, 'mtopic_id');
	}

	public function subsub_topics()
	{
		return $this->hasMany(SubsubTopic::class, 'stopic_id');
	}
}
