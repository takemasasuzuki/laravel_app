<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    // protected $table = 'todos';
    // protected $primaryKey = 'title';

    protected $fillable = [
        'title',
        'user_id'//
    ];//  代入を許可する配列を指定

    // ここから
    public function getByUserId($id)
    {
        return $this->where('user_id', $id)->get();
    }
}
