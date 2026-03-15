<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    protected $table = 'students'; // ชื่อตารางในฐานข้อมูล

    protected $fillable = ['s_id', 's_fname', 's_lname', 's_password', 'm_id', 'status'];

    protected $hidden = [
        's_password', // ซ่อนรหัสผ่าน
    ];

    /**
     * ระบุฟิลด์สำหรับรหัสผ่านที่ใช้ในการตรวจสอบสิทธิ์
     */
    public function getAuthPassword()
    {
        return $this->s_password;
    }

    /**
     * Accessor to get the student's first name.
     */
    public function getNameAttribute()
    {
        return $this->s_fname . ' ' . $this->s_lname;
    }


    /**
     * Relationship to the Major model.
     */
    public function major()
    {
        return $this->belongsTo(Major::class, 'm_id', 'id');
    }

    public function project_group()
    {
        return $this->belongsTo(ProjectGroup::class, 'group_id');
    }

    public function group_members()
    {
        return $this->hasMany(GroupMember::class, 's_id');
    }
}
