@extends('layout.bbslayout')

@section('title', 'LaravelPjt BBS 投稿の一覧ページ')
@section('keywords', 'キーワード1,キーワード2,キーワード3')
@section('description', '投稿一覧ページの説明文')
@section('pageCss')
    <link href="/css/bbs/style.css" rel="stylesheet">
@endsection

@include('layouts.app')

@section('content')

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>作成日時</th>
                <th>名前</th>
                <th>件名</th>
                <th>メッセージ</th>
                <th>処理</th>
            </tr>
            </thead>
            <tbody id="tbl">
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->created_at->format('Y.m.d') }}</td>
                    <td>{{ $post->name }}</td>
                    <td>{{ $post->subject }}</td>
                    <td>{!! nl2br(e(Str::limit($post->message, 100))) !!}
                        @if ($post->comments->count() >= 1)
                            <p><span class="badge badge-primary">コメント：{{ $post->comments->count() }}件</span></p>
                        @endif
                    </td>
                    @guest

                    @else
                    <td class="text-nowrap">
                        <div class="mt-4 mb-4">
                            <a href="{{ route('bbs.create') }}" class="btn btn-primary">
                                投稿の新規作成
                            </a>
                        </div>
                        @if (session('poststatus'))
                            <div class="alert alert-success mt-4 mb-4">
                                {{ session('poststatus') }}
                            </div>
                        @endif
                        <p><a href="{{ action('App\Http\Controllers\PostsController@show', $post->id) }}" class="btn btn-primary btn-sm">詳細</a></p>
                        @endguest
                    </td>
                </tr>
            @endforeach
            </tbody>

            <div class="d-flex justify-content-center mb-5">
                {{ $posts->links() }}
            </div>

        </table>
    </div>
@endsection

@include('layout.bbsfooter')
