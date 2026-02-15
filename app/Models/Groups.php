<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class Groups extends Model
{
    protected $table ='groups';

     public function users(){
    return $this->hasMany(
       User::class

    );}
    public function getAll(){
        $groups= DB::table($this->table)
        ->orderBy('name','ASC')
        ->get();
        return $groups;
    }
}
