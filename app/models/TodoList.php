<?php

class TodoList extends Eloquent {

  protected $fillable = ['user_id', 'title'];
  protected $table = 'lists';

  // Get the todos from this list
  public function todos(){
    return $this->hasMany('Todo', 'list_id');
  }

}