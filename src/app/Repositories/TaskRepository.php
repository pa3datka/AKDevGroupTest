<?php

namespace App\Repositories;

use App\Models\Task as Model;

class TaskRepository extends BaseRepository
{

    public function store(int $userId, array $fields): ?Model
    {
        $fields += ['user_id' => $userId];
        return $this->startConditions()->create($fields);
    }

    public function getTaskByIdAndUserId(int $userId, int $taskId): ?Model
    {
        return $this->startConditions()
            ->where(['user_id' => $userId, 'id' => $taskId])
            ->first();
    }

    public function updateTask(int $userId, int $taskId, array $fields): bool
    {
        return $this->startConditions()->where(['user_id' => $userId, 'id' => $taskId])->update($fields);
    }

    public function deleteTask(int $userId, int $taskId): bool
    {
        return $this->startConditions()->where(['user_id' => $userId, 'id' => $taskId])->delete();
    }

    public function getTasks(int $userId)
    {
        return $this->startConditions()->where(['user_id' => $userId])->get()->toArray();
    }


    protected function getModelClass(): string
    {
        return Model::class;
    }
}
