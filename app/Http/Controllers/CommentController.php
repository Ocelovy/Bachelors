<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $onlyHolidays = $request->has('holiday') && $request->query('holiday') == '1';

        $comments = Comment::with('user');

        if ($onlyHolidays) {
            $comments = $comments->where('is_holiday', true);
        }

        if (!empty($search) && !$onlyHolidays) {
            $comments = $comments->where(function($query) use ($search) {
                $query->where('comment', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereDate('created_at', $search);
            });
        }

        $comments = $comments->get();

        return view('comment', compact('comments'));
    }


    public function create()
    {
        return view('comments.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required',
            'is_holiday' => 'sometimes|boolean',
        ]);

        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->is_holiday = $request->has('is_holiday');

        if (auth()->check()) {
            $comment->user_id = auth()->id();
        }

        $comment->save();

        return redirect()->route('comment');
    }

    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);
        return redirect()->route('comment');
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate([
            'comment' => 'required',
        ]);

        $comment->update(['comment' => $request->input('comment')]);

        return redirect()->route('comment');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('comment');
    }
}
