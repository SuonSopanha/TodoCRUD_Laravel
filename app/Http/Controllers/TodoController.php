<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoReqeust;
use App\Http\Requests\UpdateTodoReqest;
use App\Http\Resources\TodoCollection;
use App\Http\Resources\TodoResouce;
use App\Models\Todo;
use App\Http\Traits\HttpResponses;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the todos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::all();
        return $this->success(new TodoCollection($todos));
    }

    /**
     * Store a newly created todo in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodoReqeust $request)
    {
        $validatedData = $request->validated();

        $todo = Todo::create($validatedData);
        return $this->success(new TodoResouce($todo), 201);
    }

    /**
     * Display the specified todo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return $this->error(null, 'Todo not found', 404);
        }


        return $this->success(new TodoResouce($todo));
    }

    /**
     * Update the specified todo in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTodoReqest $request, $id)
    {


        $todo = Todo::find($id);

        if (!$todo) {
            return $this->error(null, 'Todo not found', 404);
        }
        $validatedData = $request->validated();
        $todo->update($validatedData);
        return $this->success(new TodoResouce($todo));
    }

    /**
     * Remove the specified todo from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return $this->error(null, 'Todo not found', 404);
        }
        $todo->delete();
        return $this->success(null, 'Todo deleted');
    }
}
