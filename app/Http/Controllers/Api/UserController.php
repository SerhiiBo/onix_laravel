<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $query = User::email($request->email)
            ->betweenDates($request->startDate, $request->endDate)
            ->sortByTop($request->sortBy)
            ->trueAuthor($request->authors);
        return UserResource::collection($query->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateUserRequest $request): UserResource
    {
        $createdUser = User::create($request->validated());
        return new UserResource($createdUser);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return UserResource
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $deletedUserId = $user->id;
        $user->delete();
        return response("Пользователь с ID № $deletedUserId удалена!", Response::HTTP_NO_CONTENT);
    }
}
