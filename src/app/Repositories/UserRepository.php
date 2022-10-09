<?php

namespace App\Repositories;

use App\Models\User as Model;

class UserRepository extends BaseRepository
{

    public function createUser(array $fields): ?Model
    {
        return $this->startConditions()->create($fields);
    }

    public function getUserByEmail(string $email): mixed
    {
        return $this->startConditions()->where('email', $email)->first();
    }

    protected function getModelClass(): string
    {
       return Model::class;
    }
}
