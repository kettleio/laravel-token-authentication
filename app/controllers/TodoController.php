<?php

class TodoController extends \BaseController{

  public function index(){

    $user = API::user();
    $userList = TodoList::find($user->lists()->first()->id);

    if($userList){

      $todos = $userList->todos()->get();

      return API::response()->array(['status' => 'success', 'todos' => $todos ]);

    }

    return API::response()->array(['status' => 'failed', 'message' => 'There was an error. Please try again.' ])->statusCode(401);

  }

  public function store(){

    $validation = Validator::make(Input::all(), [
      'title' => 'required'
    ] );

    if($validation->fails()){
      return API::response()->array(['status' => 'failed', 'message' => $validation])->statusCode(200);
    }

    $user = API::user();

    $userList = TodoList::find($user->lists()->first()->id);

    try{

      $todo = new Todo([
        'title'    => Input::get('title'),
      ]);

      $todo->save();

      if($todo && $userList){
        $userList->todos()->save($todo);
      }

      return API::response()->array(['status' => 'success', 'message' => 'Todo was added!']);

    } catch(\Exception $e){

        return API::response()->array(['status' => 'failed', 'message' => 'There was an error. Please try again.' ])->statusCode(401);

    }

  }

  public function destroy($id){

    $user = API::user();
    $userList = TodoList::find($user->lists()->first()->id);

    $todo = Todo::find($id);

    if($todo && $todo->list_id == $userList->id){

      $todo->delete();

      return API::response()->array(['status' => 'success', 'message' => "Todo was deleted." ])->statusCode(200);

    }

    return API::response()->array(['status' => 'failed', 'message' => 'There was an error. Please try again.' ])->statusCode(401);

  }

}

?>  