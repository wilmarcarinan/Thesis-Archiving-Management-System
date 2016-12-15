<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'StudentID', 'FirstName',  'MiddleName', 'LastName', 'Course', 'College', 'email', 'password', 'Role', 'Status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function is_admin()
    {
        $role = $this->Role;
        if( $role == 'Admin' )
        {
            return true;
        }
        return false;
    }
}
