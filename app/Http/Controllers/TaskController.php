<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(CreateRequest $request)
    {
        return new TaskResource(Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'complete_till' => $request->complete_till
        ]));
    }

    public function read(int $id)
    {
        return new TaskResource(Task::findOrFail($id));
    }

    public function update(UpdateRequest $request)
    {
        $task = Task::findOrFail($request->id);
        $task->update($request->safe()->except('id'));

        return new TaskResource($task);
    }
}
