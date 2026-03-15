<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainTopic extends Model
{
    protected $table = 'main_topics';

	protected $fillable = ['name', 'score', 'form_id'];

	public function formset()
	{
		return $this->belongsTo(Formset::class, 'form_id');
	}

	public function sub_topics()
	{
		return $this->hasMany(SubTopic::class, 'mtopic_id');
	}
}
