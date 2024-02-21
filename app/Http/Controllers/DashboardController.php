<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Log;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
//MONITORING MANAGEMENT SYSTEM
    public function index()
{
    $email = session('email');
    $userRole = User::where('email', $email)->value('role');
    $userName = User::where('email', $email)->value('name');
    $userId = User::where('email', $email)->value('id');

    //QUERY LOGS BASED ON SUPERVISOR 
    $logs = Log::join('users', 'logs.user_id', '=', 'users.id')
    ->where('logs.supervisor_id', $userId)
    ->selectRaw('logs.id as log_id, logs.description, logs.photourl, logs.status, logs.created_at, users.name, users.role')
    ->get();
    return view('dashboard.index', ['role' => $userRole,
        'name' => $userName,
        'logs' => $logs]);
}

public function filter(Request $request) {
    $email = session('email');
    $userRole = User::where('email', $email)->value('role');
    $userName = User::where('email', $email)->value('name');
    $userId = User::where('email', $email)->value('id');
    $selectedDate = $request->input('selected_date', date('Y-m-d'));
    $logs = Log::join('users', 'logs.user_id', '=', 'users.id')
    ->where('logs.supervisor_id', $userId)
    ->selectRaw('logs.id as log_id, logs.description, logs.photourl, logs.status, logs.created_at, users.name, users.role')
    ->whereDate('logs.created_at', $selectedDate)
    ->get();
    return view('dashboard.index', [
        'role' => $userRole,
        'name' => $userName,
        'logs' => $logs
    ]);
}

public function approve($id) {
    $log = Log::find($id);
    $log->status = 'disetujui';
    $log->save();
    return redirect()->route('home')->with('success', 'Log approved successfully.');
}

public function disapprove($id) {
    $log = Log::find($id);
    $log->status = 'ditolak';
    $log->save();
    return redirect()->route('home')->with('success', 'Log disapproved successfully.');
}

//USER MANAGEMENT SYSTEM
public function users() {
    $email = session('email');
    $userRole = User::where('email', $email)->value('role');
    $userName = User::where('email', $email)->value('name');
    $users = User::leftJoin('users as supervisors', 'users.supervisor', '=', 'supervisors.id')
                ->select('users.*', 'supervisors.name as supervisor_name')
                ->get();
    return view('dashboard.users', ['users' => $users ,'role' => $userRole, 'name' => $userName]);
}


    public function edit($id) {
        $user = User::find($id);
        if ($user->role == 'staf') {
            $supervisorList = User::whereIn('role', ['man-op', 'man-uang'])->get();
        } else if ($user->role == 'man-op' || $user->role == 'man-uang') {
            $supervisorList = User::where('role', 'direktur')->get();
        }
        return view('dashboard.edit', ['user' => $user], ['supervisorList' => $supervisorList]);
    }

    public function update(Request $request, $id) {
        $user = User::find($id);
    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|string|in:staf,man-op,man-uang,direktur',
            'supervisor' => 'required|exists:users,id'
        ]);
    
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];
        $user->supervisor = $validatedData['supervisor'];
    
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function create() {
        $supervisorList = User::where('role', 'direktur')->get();
        return view('dashboard.create', ['supervisorList' => $supervisorList]);
    }
    
}
