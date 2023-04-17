<?php

namespace App\Http\Controllers;

use App\Events\Models\User\UserCreated;
use App\Events\Models\User\UserUpdated;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {



        $pageSize = $request->page_size ?? 20 ;

        $users = User::query()->paginate($pageSize);

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, UserRepository $repository)
    {
        $created = $repository->create($request->only([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ])) ;

        return new UserResource($created);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, UserRepository $repository)
    {
        $updated = $repository->update($user, $request->only([
            'name',
            'email',
            'password' ,
        ]));

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, UserRepository $repository)
    {
        $deleted = $repository->forceDelete($user);

        return new \Illuminate\Http\JsonResponse([
            'data' => 'success',
        ]);
    }
}
