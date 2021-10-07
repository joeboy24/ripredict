<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfitData extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'ics', 'vr', 'lb', 'icf', 'iln', 'icr', 'ld', 'dw', 'exp', 'obs', 'bias', 'kscale', 'profit'];

}
