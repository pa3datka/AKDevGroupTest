<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Repositories\TaskRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TaskRepository $taskRepository): JsonResponse
    {
        $tasks = $taskRepository->getTasks(Auth::id());

        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request, TaskRepository $taskRepository): JsonResponse
    {
        if ($task = $taskRepository->store(Auth::id(), $request->all())) {
            return response()->json(['id' => $task->id]);
        }

        return response()->json(null, 500);
     }

    /**
     * Display the specified resource.
     */
    public function show(int $taskId, TaskRepository $taskRepository): JsonResponse
    {
        if ($task = $taskRepository->getTaskByIdAndUserId(Auth::id(), $taskId)) {
            return response()->json($task);
        }

        return response()->json(null, 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, int $taskId, TaskRepository $taskRepository): JsonResponse
    {
        $userId = Auth::id();
        $fields = $request->all(['title', 'task', 'img_path']);
        if ($task = $taskRepository->updateTask($userId, $taskId, $fields)) {
            return response()->json(['id' => $task]);
        }

        return response()->json(null, 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($taskId, TaskRepository $taskRepository): JsonResponse
    {
        $userId = Auth::id();
        if ($taskRepository->deleteTask($userId, $taskId)) {
            return response()->json(null);
        }

        return response()->json(null, 404);
    }
}
