<?php
namespace App\Helpers;
use App\Models\{USer,Permission,Permission_role,Role};

class PermissionHelper
{
    public static function hasPermission($permission):bool
    {
        $user = auth()->user();
        $permission_roles = Permission_role::where('role_id', $user->role_id)->get();
        $permission_roles = Permission_role::whereHas('permission', function ($query) use ($permission) {
            $query->where('name', $permission);
        })->get();            if($item->permission->name == $permission)return true;

        return count($permission_roles) > 0;
    }

    public static function control($permission): bool
    {
        $user = auth()->user();
        $permission_roles = Permission_role::where('role_id', $user->role_id)->get();

        foreach ($permission_roles as $item) {
            if ($item->permission->name == $permission) {
                return true; // Si une correspondance est trouvée, retourne true immédiatement.
            }
        }

        return false; // Aucune correspondance trouvée après avoir parcouru toutes les permissions.
    }

    public static function permission_list(){
        $user = auth()->user();
        $permission_roles = [];
        if($user)$permission_roles = Permission_role::where('role_id', $user->role_id)->get();
        return $permission_roles;
    }

   
}

