<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModulePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name'=>'Super Admin'],
            ['name'=>'Admin'],
            ['name'=>'User'],
        ];
        foreach ($roles as $role){
            Role::updateOrCreate($role,$role);
        }
        $modulesAndPermissions = [
            [
                'name'=>'Users',
                'url'=>'users',
                'active'=>'users',
                'icon'=>'user-tie',
                'permissions'=>[
                    'Read User',
                    'Add New User',
                    'Edit user',
                    'Delete User',
                ],
            ],
            [
                'name'=>'Roles',
                'url'=>'roles',
                'active'=>'roles',
                'icon'=>'key',
                'permissions'=>[
                    'Read Role',
                    'Add New Role',
                    'Edit Role',
                    'Delete Role',
                    'Assign Permission',
                ],
            ],
            [
                'name'=>'Categories',
                'url'=>'categories',
                'active'=>'categories',
                'icon'=>'list-alt',
                'permissions'=>[
                    'Read Category',
                    'Add New Category',
                    'Edit Category',
                    'Delete Category',
                ],
            ],
             [
                'name'=>'Menus',
                'url'=>'menus',
                'active'=>'menus',
                'icon'=>'bars',
                'permissions'=>[
                    'Read Menu',
                    'Add New Menu',
                    'Edit Menu',
                    'Delete Menu',
                ],
            ],
              [
                'name'=>'Menu Items',
                'url'=>'menu-items',
                'active'=>'menu-item',
                'icon'=>'utensils',
                'permissions'=>[
                    'Read Menu Item',
                    'Add New Menu Item',
                    'Edit Menu Item',
                    'Delete Menu Item',
                ],
            ],
             [
                'name'=>'Price Management',
                'url'=>'price-managements',
                'active'=>'price-management',
                'icon'=>'tag',
                'permissions'=>[
                    'Read Price Management',
                    'Add New Price Management',
                    'Edit Price Management',
                    'Delete Price Management',
                ],
            ],

        ];
        foreach ($modulesAndPermissions as $modulesAndPermission){
            $module = Module::where('name',$modulesAndPermission['name'])->where('url',$modulesAndPermission['url'])->first();
            if(!$module){
                $createdModule = Module::create([
                    'name'=>$modulesAndPermission['name'],
                    'slug'=>str_replace(' ','-',strtolower($modulesAndPermission['name'])),
                    'url'=>$modulesAndPermission['url'],
                    'active'=>$modulesAndPermission['active'],
                    'icon'=>$modulesAndPermission['icon'],
                ]);
                foreach ($modulesAndPermission['permissions'] as $permission){
                    $checkPermission = Permission::where('module_id',$createdModule->id)->where('name',$permission)->first();
                    if(!$checkPermission){
                        Permission::create([
                            'module_id'=>$createdModule->id,
                            'name'=>$permission,
                            'slug'=>str_replace(' ','-',strtolower($permission)),
                        ]);
                    }
                }
            }
        }

    }
}
