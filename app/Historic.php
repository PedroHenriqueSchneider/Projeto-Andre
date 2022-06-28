<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
        use SoftDeletes;
    
        public $table = 'users';
    
        protected $dates = [
            'created_at',
            'updated_at',
            'deleted_at',
        ];
    
        protected $fillable = [
            'title',
            'created_at',
            'updated_at',
            'deleted_at',
        ];
        public function roles()
        {
            return $this->belongsToMany(Role::class);
        }
}
