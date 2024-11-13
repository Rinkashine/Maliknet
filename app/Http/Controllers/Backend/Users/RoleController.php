<?php

namespace App\Http\Controllers\Backend\Users;

use App\Exports\RoleExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //Show Role Page
    public function index()
    {
        abort_if(Gate::denies('role_access'), 403);

        return view('admin.page.Users.role');
    }

    //Edit Role Name
    public function edit(Role $role)
    {
        abort_if(Gate::denies('role_edit'), 403);
        $permissions = Permission::all();

        return view('admin.page.Users.roleedit', compact('role', 'permissions'));
    }

     //Export Role to Excel
     public function exportroleexcel()
     {
         return Excel::download(new RoleExport, 'roles.xlsx');
     }

    //Export Role to CSV
    public function exportrolecsv()
    {
        return Excel::download(new RoleExport, 'roles.csv');
    }

    //Export Role to HTML
    public function exportrolehtml()
    {
        return Excel::download(new RoleExport, 'roles.html');
    }

    //Export Role to PDF
    public function exportrolepdf()
    {
        return Excel::download(new RoleExport, 'roles.pdf');
    }
}
