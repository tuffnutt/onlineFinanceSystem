<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = [
     'comment_body',
     'commentable_id',
     'commentable_type',
     'comment_user_id'

 ];

 public function commentable()
 {
     return $this->morphTo();
 }


     /**
  * Return the user associated with this comment.
  *
  * @return array
  */
  public function user()
  {
      return $this->hasOne('\App\User', 'id', 'comment_user_id');
  }
}
