<?php namespace LibChat\Comments\Http\Controllers;

use Illuminate\Http\Request;
use LibUser\UserApi\Models\User;
use Illuminate\Routing\Controller;
use LibChat\Comments\Models\Comment;
use LibChat\Comments\Http\Resources\CommentResource;

class CommentsController extends Controller
{
    /*
     * Index
     */
    public function index(Request $request, $model, $model_id, User $user)
    {
        $data = Comment::where('commentable_type', $model['class'])->where('commentable_id', (int) $model_id)->get();
        
        if ($model['order_direction'] == 'asc') {
            $sorted = $data->sortBy($model['order_column']);
        } else {
            $sorted = $data->sortByDesc($model['order_column']);
        }
        
        $sorted = $sorted->each(function($item) use ($model) {
            if (!$item->answers->isEmpty()) {
                $data = $item->answers;
                
                if ($model['order_direction'] == 'asc') {
                    $sorted = $data->sortBy($model['order_column']);
                } else {
                    $sorted = $data->sortByDesc($model['order_column']);
                }
                
                $item->answers = $sorted->values();
            }
        });
        
        return CommentResource::collection(
            $sorted->values()
        );
    }
    
    /*
     * Show
     */
    public function show(Request $request, Comment $comment)
    {
        return new CommentResource($comment);
    }
    
    /*
     * Store
     */
    public function store(Request $request, $model, $model_id, User $user)
    {
        $comment = new Comment;
        $comment->creatable = $user;
        $comment->commentable_type = $model['class'];
        $comment->commentable_id = $model_id;
        $comment->content = $request->text;
        
        $comment->save();
        
        return new CommentResource($comment);
    }
    
    /*
     * Update
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->update([
            'content' => $request->text,
        ]);
        
        return new CommentResource($comment->reload());
    }
    
    /*
     * Destroy
     */
    public function destroy(Request $request, Comment $comment)
    {
        $comment->delete();
        
        return new CommentResource($comment);
    }
}