<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
 use App\Models\User;

class LogController extends Controller
{
    public function index() {
        $email = session('email');
        $userRole = User::where('email', $email)->value('role');
        $logs = Log::all();
        return view('log.index', ['logs' => $logs], ['role' => $userRole]);
    }

    public function create() {
        return view('log.create');
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
    'description' => 'required|string',
    'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
    ]);
    
        $newData = new Log();
        $newData->description = $validatedData['description'];
        $newData->status = 'pending';
        $newData->save();
    
        if ($request->hasFile('photo')) {
    $photoPath = $request->file('photo')->store('public/logphotos');
    
    $newData->photourl = str_replace('public/', '', $photoPath);

    $user = User::where('email', session('email'))->first();
    
    $newData->user_id = $user->id;
    $newData->supervisor_id = $user->supervisor;

    $newData->save();
    }
    
        return redirect()->route('log.index');
    }

    public function destroy($id) {
        
    }
}
