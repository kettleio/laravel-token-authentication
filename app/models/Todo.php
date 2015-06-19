<?php

class Todo extends Eloquent {

  protected $fillable = ['list_id', 'title'];
  protected $table = 'todos';

  // Get the list of this todo
  public function todoList(){
    return $this->belongsTo('TodoList', 'list_id');
  }

}