<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * 一覧画面
     *
     * @return \Illuminate\Http\Contracts\View\View
     */
    public function index()
    {
        // 記事一覧取得
        $posts = Post::with('user')->latest('id')->paginate(20);
        return view('back.posts.index', compact('posts'));
    }

    /**
     * 新規登録画面
     *
     * @return \Illuminate\Http\Contracts\View\View
     */
    public function create()
    {

        return view('back.posts.create');
    }

    /**
     * 更新処理
     *
     * @param  App\Http\Requests\PostRequest $request
     * @return \Illuminate\Http\Contracts\View\View
     */
    public function store(PostRequest $request)
    {
        // postモデルでfilableに指定している値が全て取れる
        $post = Post::create($request->all());

        if ($post) {
            return redirect()
                ->route('back.posts.edit', $post)
                ->withSuccess('データに登録しました。');
        } else {
            return redirect()
                ->route('back.posts.create')
                ->withError('データの登録に失敗しました。');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 編集画面
     *
     * @param  array App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // データ登録した時に受け取った値をそのままビューに渡す
        return view('back.posts.edit', compact('post'));
    }

    /**
     * 編集更新
     *
     * @param  App\Http\Requests\PostRequest $request
     * @param  App\Models\Post　$post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        if ($post->update($request->all())) {
            $flash = ['success' => 'データを更新しました。'];
        } else {
            $flash = ['error' => 'データの更新に失敗しました'];
        }

        return redirect()
            ->route('back.posts.edit', $post)
            ->with($flash);
    }

    /**
     * 削除処理
     *
     * @param  App\Models\Post　$post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->delete()) {
            $flash = ['success' => 'データを削除しました。'];
        } else {
            $flash = ['error' => 'データの削除に失敗しました'];
        }

        return redirect()
            ->route('back.posts.index')
            ->with($flash);
    }
}
