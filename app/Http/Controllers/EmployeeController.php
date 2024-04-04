<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\EmployeeResource;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use File;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with(['user:id', 'user.roles:id,name'])
            ->paginate(6)
            ->onEachSide(0);
        return inertia('Employee/Index', [
            'employees' => EmployeeResource::collection($employees)
            // 'employees' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Employee/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $fields = $request->validated();
        $selected_role = $fields['role'];

        unset($fields['role']);
        
        // Create User
        $credentials = [
            'username' => $request->id_no,
            'password' => bcrypt(strtoupper(substr($request->lname, 0, 3)).'_'.$request->id_no) // Extracts the first three letters of the last name, and capitalize it then concatenate with the id number.
        ];

        $user = User::create($credentials);
        $user->assignRole($selected_role);

        if($request->profile_photo) {
            $destination_path = 'public/uploads/profile_photos';
            $photo_name = time().'.'.$request->profile_photo->extension();
            $request->profile_photo->storeAs($destination_path, $photo_name);
            $fields['profile_photo'] = $photo_name;
        }

        $user->employee()->create($fields);

        return redirect(route('employee.index'))->with('success', 'A new employee has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $credentials = [
            'username' => $employee->id_no,
            'password' => strtoupper(substr($employee->lname, 0, 3)).'_'.$employee->id_no
        ];

        return inertia('Employee/Credentials', [ 'credentials' => $credentials ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        // dd($employee);
        return inertia('Employee/Edit', [
            'employee' => EmployeeResource::make($employee)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $fields = $request->validated();
        $selected_role = $fields['role'];
        unset($fields['role']);

        $user = User::find($employee->user_id);

        if($selected_role != $user->getRoleNames()->first()) {
            $user->roles()->detach();
            $user->assignRole($selected_role);
        }

        if($request->profile_photo) {

            if($employee->profile_photo) {
                File::delete(storage_path('app/public/uploads/profile_photos/'.$employee->profile_photo));
            }

            $destination_path = 'public/uploads/profile_photos';
            $photo_name = time().'.'.$request->profile_photo->extension();
            $request->profile_photo->storeAs($destination_path, $photo_name);
            $fields['profile_photo'] = $photo_name;
        }

        $employee->update($fields);

        return redirect(route('employee.index'))->with('success', 'Employee details successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        $employee->user()->delete();

        return back()->with('success', 'Employee has been deleted!');
    }

    public function toggleStatus(Employee $employee)
    {
        $employee->status = !$employee->status;

        $employee->save();

        return back();
    }
}
