<?php

namespace App\Repositories;

use App\Events\Models\User\UserCreated;
use App\Events\Models\User\UserUpdated;
use App\Events\UserDeleted;
use App\Exceptions\GeneralJsonException;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository
{
    /**
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $created = User::query()->create([
                'name' => data_get($attributes, 'name', ''),
                'email' => data_get($attributes, 'email'),
                'password' => data_get($attributes, 'password'),
            ]);

            throw_if(!$created, GeneralJsonException::class,'Failed to create User.');

            event(new UserCreated($created)) ;

            return $created;
        });
    }

    /**
     * @param $user
     * @param array $attributes
     * @return mixed
     */
    public function update($user, array $attributes)
    {
        return DB::transaction(function () use ($user, $attributes){
            $updated = $user->update([
                'name' => data_get($attributes, 'name', $user->name),
                'email' => data_get($attributes, 'email', $user->email),
                'password' => data_get($attributes, 'password', $user->password),
            ]);

            throw_if(!$updated, GeneralJsonException::class,'Failed to update user');

            event(new UserUpdated($updated)) ;

            return $user ;
        });
    }

    /**
     * @param $user
     * @return mixed
     */
    public function forceDelete($user)
    {
        return DB::transaction(function () use ($user){
            $deleted = $user->forceDelete() ;

            throw_if(!$deleted, GeneralJsonException::class,'Failed to delete User');

            event(new UserDeleted($deleted)) ;

            return $deleted ;
        });
    }

}
