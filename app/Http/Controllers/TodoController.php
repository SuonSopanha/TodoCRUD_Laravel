<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoReqeust;
use App\Http\Requests\UpdateTodoReqest;
use App\Http\Resources\TodoCollection;
use App\Http\Resources\TodoResouce;
use App\Models\Todo;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Your API Title",
 *      description="Your API Description",
 *      termsOfService="http://example.com/terms/",
 *      @OA\Contact(
 *          email="contact@example.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 */

class TodoController extends Controller
{
    /**
     * Display a listing of the todos.
     *
     * @OA\Get(
     *     path="/api/todos",
     *     summary="Get all todos",
     *     tags={"Todos"},
     *     @OA\Response(
     *         response=200,
     *         description="List of todos",
     *
     *     )
     * )
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::all();
        return new TodoCollection($todos);
    }

    /**
     * Store a newly created todo in storage.
     *
     * @OA\Post(
     *     path="/api/todos",
     *     summary="Create a new todo",
     *     tags={"Todos"},
     *     @OA\RequestBody(
     *         required=true,
     *            @OA\JsonContent(
     *             required={"title"},
     *              @OA\Property(property="user_id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="description", type="string"),
     *              @OA\Property(property="completed", type="boolean"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Todo created successfully",
     *
     *     )
     * )
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodoReqeust $request)
    {
        $validatedData = $request->validated();

        $todo = Todo::create($validatedData);
        return new TodoResouce($todo, 201);
    }

    /**
     * Display the specified todo.
     *
     * @OA\Get(
     *     path="/api/todos/{id}",
     *     summary="Get a specific todo by ID",
     *     tags={"Todos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the todo",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *
     *
     *     @OA\Response(
     *         response=200,
     *         description="Todo details",
     *
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Todo not found"
     *     )
     * )
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json(['error' => 'Todo not found'], 404);
        }

        return new TodoResouce($todo);
    }

    /**
     * Update the specified todo in storage.
     *
     * @OA\Put(
     *     path="/api/todos/{id}",
     *     summary="Update a specific todo by ID",
     *     tags={"Todos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the todo",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *      @OA\RequestBody(
     *         required=true,
     *            @OA\JsonContent(
     *             required={"title"},
     *              @OA\Property(property="user_id", type="integer"),
     *             @OA\Property(property="title", type="string"),
     *             @OA\Property(property="description", type="string"),
     *              @OA\Property(property="completed", type="boolean"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Todo updated successfully",
     *
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Todo not found"
     *     )
     * )
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTodoReqest $request, $id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json(['error' => 'Todo not found'], 404);
        }

        $validatedData = $request->validated();
        $todo->update($validatedData);
        return new TodoResouce($todo);
    }


    /**
     * Remove the specified todo from storage.
     *
     * @OA\Delete(
     *     path="/api/todos/{id}",
     *     summary="Delete a specific todo by ID",
     *     tags={"Todos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the todo",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Todo deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Todo not found"
     *     )
     * )
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json(['error' => 'Todo not found'], 404);
        }

        $todo->delete();
        return response()->json(null, 204);
    }
}
