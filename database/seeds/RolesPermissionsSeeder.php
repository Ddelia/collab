<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create permissions
        try
        {
            Permission::findByName('view_all_tasks');
        }
        catch (\Exception $e)
        {
            if ($e->getMessage() == 'There is no permission named `view_all_tasks` for guard `web`.')
            {
                Permission::create(['name' => 'view_all_tasks']);
            }
        }
        try
        {
            Permission::findByName('add_any_task');
        }
        catch (\Exception $e)
        {
            if ($e->getMessage() == 'There is no permission named `add_any_task` for guard `web`.')
            {
                Permission::create(['name' => 'add_any_task']);
            }
        }

        //create roles
        try
        {
            Role::findByName('admin');
        }
        catch (\Exception $e)
        {
            if($e->getMessage() == 'There is no role named `admin`.')
            {
                Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());
            }
        }

        try
        {
            Role::findByName('co-worker');
        }
        catch (\Exception $e)
        {
            if($e->getMessage() == 'There is no role named `co-worker`.')
            {
                Role::create(['name' => 'co-worker']);
            }
        }

        try
        {
            Role::findByName('tester');
        }
        catch (\Exception $e)
        {
            if($e->getMessage() == 'There is no role named `tester`.')
            {
                Role::create(['name' => 'tester']);
            }
        }
    }
}
