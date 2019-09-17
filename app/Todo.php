<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
  //論理削除
    use SoftDeletes;

    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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
