<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Propose extends Model
{

    use HasFactory;

    protected $table = 'proposes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',        // Add title
        'objective',
        'scope',
        'tools',
        'a_id',
        'comments',
        'group_id',     // If group_id is used
        'status',
        'type_id',
    ];

    public function project_group()
    {
        return $this->belongsTo(ProjectGroup::class, 'group_id');
    }

    public function advisor()
    {
        return $this->belongsTo(Advisor::class, 'a_id', 'id');
    }

    // public function propose_histories()
    // {
    // 	return $this->hasMany(ProposeHistory::class);
    // }

    public function project_type()
	{
		return $this->belongsTo(ProjectType::class, 'type_id');
	}

    public function exam_submissions()
    {
        return $this->hasMany(ExamSubmission::class);
    }

    public function propose_histories()
    {
        return $this->hasMany(ProposeHistory::class);
    }
}
