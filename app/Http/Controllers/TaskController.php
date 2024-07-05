<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRequest;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\ListRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Создание новой задачи
     * @bodyParam title string required Example: Задача 1
     * @bodyParam description string required Example: Это задача №1
     * @bodyParam complete_till integer required Example: 1720526400
     */
    public function create(CreateRequest $request)
    {
        return new TaskResource(Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'complete_till' => $request->complete_till
        ]));
    }

    /**
     * Получение задачи по id
     */
    public function read(int $id)
    {
        return new TaskResource(Task::findOrFail($id));
    }

    /**
     * Обновление задачи
     * @bodyParam title string required Example: Задача 2
     * @bodyParam description string required Example: Это задача №2
     * @bodyParam complete_till integer required Example: 1720526400
     */
    public function update(UpdateRequest $request)
    {
        $task = Task::findOrFail($request->id);
        $task->update($request->safe()->except('id'));

        return new TaskResource($task);
    }

    /**
     * Удаление задачи
     */
    public function delete(DeleteRequest $request)
    {
        Task::findOrFail($request->id)->delete();
        return TaskResource::collection(Task::all());
    }

    /**
     * Получение списка задач с возможностью поиска по статусу и крайнему сроку выполнения
     * @queryParam search[status] boolean Example: false
     * @queryParam search[complete_till] integer Example: 1720526400
     */
    public function list(ListRequest $request)
    {
        $query = Task::query();

        $request->whenFilled('search.status', function($status) use ($query) {
            $query->where('status', $status);
        });

        $request->whenFilled('search.complete_till', function($completeTill) use ($query) {
            $completeTill = Carbon::createFromTimestamp($completeTill)->toDateTimeString();
            $query->where('complete_till', $completeTill);
        });

        return TaskResource::collection($query->get());
    }
}
