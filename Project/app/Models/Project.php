<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description','time_progress', 'task_progress', 'client_id', 'manager_id'];

    public function client() {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function manager() {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
