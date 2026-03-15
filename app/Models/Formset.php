<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formset extends Model
{
    protected $table = 'formsets';

    protected $fillable = ['project_type_id', 'name'];

    public function project_type()
    {
        return $this->belongsTo(ProjectType::class, 'project_type_id');
    }

    public function main_topics()
    {
        return $this->hasMany(MainTopic::class, 'form_id');
    }
}
