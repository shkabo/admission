<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Roles;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password', 'active', 'phone', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsTo('App\Roles');
    }

    public function hasRole($role) {
        return (\Auth::check() && $this->role->name === $role);
    }

    public function isAdmin() {
        return (\Auth::check() && $this->role->name === 'administrator');
    }

    public function isStaff() {
        return (\Auth::check() && $this->role->name === 'staff');
    }

    public function isStudent() {
        return (\Auth::check() && $this->role->name === 'student');
    }

}
