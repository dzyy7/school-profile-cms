<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class settings extends Model
{
    // Tentukan primary key sebagai 'key'
    protected $primaryKey = 'key';

    // Matikan incrementing karena key berupa string
    public $incrementing = false;

    // Tipe key adalah string
    protected $keyType = 'string';

    protected $fillable = ['key', 'value'];
}
