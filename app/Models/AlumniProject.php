<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumniProject extends Model
{
    use HasFactory;

    protected $table = 'alumni_project';

    protected $fillable = [
        'title',
        'project_type_id',
        'project_group_id',
        'keyword',
        'advisor_id',
    ];


    // ประเภทโครงงาน
    public function projectType()
    {
        return $this->belongsTo(ProjectType::class);
    }

    // อาจารย์ที่ปรึกษา
    public function advisor()
    {
        return $this->belongsTo(Advisor::class);
    }

    public function projectGroup()
    {
        return $this->belongsTo(ProjectGroup::class);
    }

    public function files()
    {
        return $this->morphMany(UploadFile::class, 'fileable');
    }
}
