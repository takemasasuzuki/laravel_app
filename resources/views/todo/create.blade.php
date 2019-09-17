@extends ('layouts.app')
@section ('content')

<h2 class="mb-3">ToDo作成</h2>
{!! Form::open(['route' => 'todo.store']) !!}<!--routeキーを利用してルーティング名を指定-->
  <div class="form-group">
    {!! Form::input('text', 'title', null, ['required', 'class' => 'form-control', 'placeholder' => 'ToDo内容']) !!}
  </div>
  {!! Form::submit('追加', ['class' => 'btn btn-success float-right']) !!}
{!! Form::close() !!}

@endsection