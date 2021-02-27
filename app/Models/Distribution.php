<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    protected $table = 'distributions';
    protected $fillable = [
        'expert_id',
        'site_id',
    ];
    protected $primaryKey = 'dist_id';
    use HasFactory;
}
