<?php
namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest; // ←★追加
use App\Models\Comment; //  ←★追加

class CommentsController extends Controller
{
    /**
     * バリデーション、登録データの整形など
     */
    public function store(CommentRequest $request)
    {
        $savedata = [
            'post_id' => $request->post_id,
            'name' => $request->name,
            'comment' => $request->comment,
        ];

        $comment = new Comment;
        $comment->fill($savedata)->save();

        return redirect()->route('bbs.show', [$savedata['post_id']])->with('commentstatus','コメントを投稿しました');
    }
    public function edit(CommentRequest $request)
    {
        $savedata = [
            'post_id' => $request->post_id,
            'name' => $request->name,
            'comment' => $request->comment,
            "ancestor" =>$request->ancestor,
        ];

        $comment = new Comment;
        $comment->fill($savedata)->save();

        return redirect()->route('bbs.edit', [$savedata['ancestor']])->with('commentstatus','コメントを返信しました');
    }
}
