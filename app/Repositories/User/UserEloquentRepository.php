<?php

namespace App\Repositories\User;

class UserEloquentRepository extends EloquentRepository implements UserRepositoryInterface
{
    /**
     * Get model.
     *
     * @return string
     */
    public function getModel() {
        return User::class;
    }
}
