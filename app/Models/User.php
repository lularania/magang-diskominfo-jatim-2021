<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // * Using Accessors, access: Auth::user()->nama
    protected $appends = ['nama'];

    public function getNamaAttribute()
    {
        $user = Auth::user();

        if ($user->id_role == 1) {
            return Employee::where('id_user', $user->id)->first()->nama;
        } elseif ($user->id_role == 2) {
            return Employee::where('id_user', $user->id)->first()->nama;
        } elseif ($user->id_role == 3) {
            return Employee::where('id_user', $user->id)->first()->nama;
        } elseif ($user->id_role == 4) {
            return AdminOPD::where('id_user', $user->id)->first()->nama;
        } else {
            return null;
        }
    }

    public function getData()
    {
        return DB::table('users')
            ->leftJoin('roles', 'users.id_role', '=', 'roles.id')
            ->get();
    }

    public function addData($data)
    {
        return DB::table('users')->insert($data);
    }

    public function updateData($id, $data)
    {
        return DB::table('users')
            ->where('id', $id)
            ->update($data);
    }

    public function deleteData($id)
    {
        return DB::table('users')
            ->where('id', $id)
            ->delete();
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'id_user');
    }

    public function adminOpd()
    {
        return $this->hasOne(AdminOpd::class, 'id_user');
    }
}