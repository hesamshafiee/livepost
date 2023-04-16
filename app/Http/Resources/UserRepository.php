<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Repositories\BaseRepository;
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
            if (!$updated)
                throw new \Exception('Failed to update user');

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

            if(!$deleted)
                throw new \Exception('Failed to delete User');

            return $deleted ;
        });
    }

}
