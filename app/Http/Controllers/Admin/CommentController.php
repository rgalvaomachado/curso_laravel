<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $model;
    protected $user;

    public function __construct(Comment $comment, User $user)
    {
        $this->model = $comment;
        $this->user = $user;
    }

    public function index($userId)
    {
        $user = $this->user->find($userId);
        if (!$user){
            return redirect()->route('users.index');
        }
        
        $comments = $user->comments()->get();
        return view('users.comments.index',compact('user', 'comments'));
    }

    public function create($userId)
    {
        $user = $this->user->find($userId);
        if (!$user){
            return redirect()->route('users.comments.index',compact('user'));
        }

        $comments = $user->comments()->get();
        return view('users.comments.create',compact('user', 'comments'));
    }

    public function store($userId, Request $request)
    {
        $user = $this->user->find($userId);
        if (!$user){
            return redirect()->route('users.comments.index',compact('user'));
        }

        $data = $request->all();
        $data['visible'] = isset($data['visible']) ? 1 : 0;
        $user->comments()->create($data);

        $comments = $user->comments()->get();
        return view('users.comments.index',compact('user', 'comments'));
    }

    public function edit($userId, $commentId){
        $comments = $this->model->find($commentId);
        if (!$comments){
            return redirect()->route('users.comments.index',compact('userId'));
        }

        $user = $this->user->find($userId);
        if (!$user){
            return redirect()->route('users.comments.index',compact('user'));
        }

        return view('users.comments.edit',compact('user', 'comments'));
    }

    public function update($userId, $commentId, Request $request){
        $comment = $this->model->find($commentId);
        if (!$comment){
            return redirect()->route('users.comments.index',compact('userId'));
        }

        $user = $this->user->find($userId);
        if (!$user){
            return redirect()->route('users.comments.index',compact('user'));
        }

        $data = $request->all();
        $data['visible'] = isset($data['visible']) ? 1 : 0;
        $comment->update($data);

        $comments = $user->comments()->get();
        return view('users.comments.index',compact('user', 'comments'));
    }
}
