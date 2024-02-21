<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class LogController extends Controller
{

    //READ
    public function index() {
        $email = session('email');
        $userRole = User::where('email', $email)->value('role');
        $userName = User::where('email', $email)->value('name');
        $userId = User::where('email', $email)->value('id');

        $logs = Log::where('user_id', $userId)->get();
        return view('log.index', [
            'logs' => $logs,
            'role' => $userRole,
            'name' => $userName
        ]);
    }

    public function filter(Request $request)
{
    $email = session('email');
    $userRole = User::where('email', $email)->value('role');
    $userName = User::where('email', $email)->value('name');
    $userId = User::where('email', $email)->value('id');
    $selectedDate = $request->input('selected_date', date('Y-m-d'));
    $logs = Log::where('user_id', $userId)
    ->whereDate('created_at', $selectedDate)->get();
    return view('log.index', [
        'logs' => $logs,
        'role' => $userRole,
        'name' => $userName
    ]);
}

    //CREATE
    public function create() {
        return view('log.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
    'description' => 'required|string',
    'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
    ]);
        $user = User::where('email', session('email'))->first();
        $newData = new Log();
        $newData->description = $validatedData['description'];
        $newData->status = 'pending';
        $newData->user_id = $user->id;
        $newData->supervisor_id = $user->supervisor;
        $newData->save();
    
        if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('public/logphotos');
                
                $newData->photourl = str_replace('public/', '', $photoPath);

                

                $newData->user_id = $user->id;
                $newData->supervisor_id = $user->supervisor;

                $newData->save();
    }
    
        return redirect()->route('log.index')->with('success', 'Log created successfully.');
    }

    //DELETE
    public function destroy($id) {
        $log = Log::findOrFail($id);
        
        if ($log->photourl && Storage::exists('public/' . $log->photourl)) {
            Storage::delete('public/' . $log->photourl);
        }
        
        $log->delete();

        return redirect()->route('log.index')->with('success', 'Log entry deleted successfully');
    }


    //EDIT
    public function edit($id) {
        $log = Log::findOrFail($id);
        return view('log.edit', ['log' => $log]);
    }

    public function update(Request $request, $id) {
    $log = Log::findOrFail($id);
    $log->description = $request->input('description');

    if ($request->hasFile('photo')) {
        if ($log->photourl && Storage::exists('public/' . $log->photourl)) {
            Storage::delete('public/' . $log->photourl);
        }
        $photoPath = $request->file('photo')->store('public/logphotos');
        $log->photourl = str_replace('public/', '', $photoPath);
    }

    $log->save();
    return redirect()->route('log.index')->with('success', 'Log entry updated successfully');
}
}
