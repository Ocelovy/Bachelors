<?php

namespace App\Http\Controllers;

use Aginev\Datagrid\Datagrid;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct() {
        $this->authorizeResource(User::class, 'user');
    }

    public function commentView()
    {
        $comments = Comment::all();
        return view('comment', compact('comments'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::paginate(25);
        return view('user.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create', [
            'action' => route('user.store'),
            'method' => 'post'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'titlesBefore' => 'nullable|string|max:255',
            'titlesAfter' => 'nullable|string|max:255',
        ]);

        $user = User::create($request->all());
        $user->save();
        return redirect()->route('user.index')->with('alert', 'Uživateľ bol vytvorený úspešne !');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->password = '';
        return view('user.edit', [
            'action' => route('user.update', $user->id),
            'method' => 'put',
            'model' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
           'name' => 'required',
           'email' => 'required|email',
           'password' => 'required|min:8|confirmed',
           'titlesBefore' => 'nullable|string|max:255',
           'titlesAfter' => 'nullable|string|max:255',
        ]);
        $user->update($request->all());
        return redirect()->route('user.index')->with('alert', 'Uživateľ bol úspešne aktualizovaný!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('alert', 'Užívateľ bol úspešne vymazaný!');
    }

    public function updatePhoto(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'photo' => 'required|image',
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');

            if ($photo->getSize() > 2048 * 1024) {
                return back()->with('error', 'Veľkosť fotky nesmie byť väčšia ako 2MB.');
            }

            try {
                if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                    Storage::disk('public')->delete($user->photo);
                }

                $path = $photo->store('user_photos', 'public');
                $user->update(['photo' => $path]);

                return back()->with('success', 'Fotka bola úspešne aktualizovaná.');
            } catch (\Exception $e) {
                return back()->with('error', 'Nepodarilo sa nahrať fotku. Skúste to prosím znova.');
            }
        } else {
            return back()->with('error', 'Žiadny súbor fotky nebol odoslaný.');
        }
    }
    public function deletePhoto()
    {
        $user = Auth::user();

        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);

            $user->photo = null;
            $user->save();

            return back()->with('success', 'Fotka bola úspešne odstránená.');
        }
        return back()->with('error', 'Nemáte priradenú žiadnu fotku profilu.');
    }

    public function updateTitles(Request $request, $userId) {
        $validatedData = $request->validate([
            'titlesBefore' => 'nullable|string|max:50',
            'titlesAfter' => 'nullable|string|max:50',
        ]);

        $user = User::findOrFail($userId);
        $user->update($validatedData);

        return redirect()->route('user.profile')->with('success', 'Tituly boli aktualizované úspešne.');
    }

}

