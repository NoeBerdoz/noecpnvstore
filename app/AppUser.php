<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
    public $timestamps = false;
    public $table = "users";
}
