<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // Define which attributes are mass assignable
    protected $fillable = ['name', 'phone'];
}
