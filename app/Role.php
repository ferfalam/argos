<?php namespace App;

use App\Observers\RoleObserver;
use App\Scopes\CompanyScope;
use Trebol\Entrust\EntrustRole;

class Role extends EntrustRole
{

    public static function boot()
    {
        parent::boot();

        static::observe(RoleObserver::class);

        static::addGlobalScope(new CompanyScope);
    }

    public function permissions()
    {
        return $this->hasMany(PermissionRole::class, 'role_id');
    }

    public function roleuser()
    {
        return $this->hasMany(User::class, 'second_role_id');
    }

    public function parent()
    {
        return $this->belongsTo(Role::class, 'parent_id');
    }

    /**
     * Get all of the modules for the Role
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modules()
    {
        $moduleInPackageInit = (array)json_decode(company()->package->module_in_package);
        $moduleInPackage = array_map(function ($n)
        {
            $v =  explode('.', $n);
            if($this->parent->name == "employee"){
                return $n;
            }else if($this->parent->name == "client"){
                return $n;
            } elseif (count($v) > 1 && $v[1] != 'title') {
                return $n;
            } else if(count($v) == 1 && !in_array($n, ["payments","leads","timelogs","invoices","expenses","tickets","products","reports","estimates","issues"])){
                return $n;
            }
        }, $moduleInPackageInit);
        return $this->hasMany(ModuleSetting::class, 'type', 'name')->whereIn('module_name', $moduleInPackage);
    }

}
