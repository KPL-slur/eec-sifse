<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    use HasFactory;

    protected $table = 'recommendations';

    protected $primaryKey = 'rec_id';

    protected $fillable = [
        'head_id',
        'name',
        'jumlah_unit_needed',
        'year',
    ];

    //ONE TO MANY INVERSE
    public function headReports()
    {
        return $this->belongsTo(HeadReport::class, 'head_id', 'head_id');
    }

}
