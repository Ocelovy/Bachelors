<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;
use App\Models\User;
use Illuminate\Http\Request;

class UserAmbulanceController extends Controller
{
    public function index()
    {
        $ambulances = Ambulance::all();
        return view('ambulances.index', compact('ambulances'));
    }

    public function update(Request $request, Ambulance $ambulance)
    {
        $validated = $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        $ambulance->users()->sync($validated['user_ids']);

        return redirect()->route('ambulances.index')->with('success', 'Užívatelia boli priradení.');
    }

    public function create()
    {
        return view('ambulances.index');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Ambulance::create($validatedData);

        return redirect()->route('ambulances.index')->with('success', 'Nová ambulancia bola pridaná.');
    }

    public function edit($id)
    {
        $ambulance = Ambulance::findOrFail($id);
        $users = User::where('role', '!=', 'user')->get();

        return view('ambulances.edit', compact('ambulance', 'users'));
    }

    public function __construct() {
        $this->middleware('auth');
    }
    protected $appends = ['title'];

    public function getTitleAttribute() {
        return $this->attributes['title'] ?? '';
    }

    public function assignForm($ambulanceId)
    {
        $ambulance = Ambulance::findOrFail($ambulanceId);
        $assignedUserIds = $ambulance->users()->pluck('users.id')->toArray();
        $users = User::whereIn('role', ['Doktor', 'Staff'])->whereNotIn('id', $assignedUserIds)->get();
        return view('ambulances.assign', compact('ambulance', 'users'));
    }
    public function editEmployees($id) {
        $ambulance = Ambulance::find($id);
        $users = User::where('role', '!=', 'user')->get();

        return view('ambulances.edit', compact('ambulance', 'users'));
    }
    public function assign(Request $request, Ambulance $ambulance)
    {
        $userIds = $request->input('user_ids');

        $validated = $request->validate([
            'user_ids.*' => 'exists:users,id',
        ]);

        $ambulance->users()->syncWithoutDetaching($userIds);

        return redirect()->route('ambulances.edit', $ambulance->id)->with('success', 'Užívatelia boli úspešne priradení k ambulancii.');
    }

    public function remove(Request $request, Ambulance $ambulance, User $user)
    {
        $ambulance->users()->detach($user->id);

        return redirect()->route('ambulances.edit', $ambulance->id)->with('success', 'Užívateľ bol úspešne odstránený z ambulancie.');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $ambulances = Ambulance::where('name', 'like', '%' . $search . '%')->get();

        if ($request->ajax()) {
            return response()->json($ambulances);
        }

        return view('ambulances.index', compact('ambulances'));
    }




}
