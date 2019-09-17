<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;  //app/Todo.php を使用することができます
use Auth;

class TodoController extends Controller
{
    private $todo;//このClass以外からのアクセスを避けたい変数 の定義

    public function __construct(Todo $instanceClass)
    {
        $this->middleware('auth');  // authミドルウェアメソッドを呼び出,、ログインユーザーのみアクセスを許す
        $this->todo = $instanceClass;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //return "Hello world!";
        //return view('layouts.app');
        // $todos = $this->todo->all();
        $todos = $this->todo->getByUserId(Auth::id());  // Auth::id()現在認証されているユーザーのID取得
        return view('todo.index', compact('todos'));  //

        // return view('todo.index', ['todos' => $this->todo->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');  // 追記
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 以下 returnまで追記
        $input = $request->all();//formで送られてきたデータを配列で全件取得
        $input['user_id'] = Auth::id();  // 追記
        $this->todo->fill($input)->save();
        //fill()で$inputの配列でtodoクラスのfillableで指定したキーと一致しているか確認し、Todoインスタンスのtitleプロパティに値を代入、saveでTodosテーブルに保存
        return redirect()->to('todo');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = $this->todo->find($id);  // 追記
        return view('todo.edit', compact('todo'));  // 追記
        //第一引数でviewsディレクトリにあるファイルを指定、第二関数でbladeに受け渡すデータを設定
        //compact()で引数に指定した値と対応する変数をkeyに設定し、変数の値をvalueに設定し配列を作成する。[ key => value ]keyと対応する変数を使用することでview側で値を使用できる。
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->todo->find($id)->fill($input)->save();//SELECTとUPDATEのSQL文が発行される
        return redirect()->to('todo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->todo->find($id)->delete();//SELECTとDELETEのSQL文が発行される
        return redirect()->to('todo');
    }
}
