<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        if (!$request->query()) {
            return UserResource::collection(User::all());
        } elseif ($request->query('keywords')) {
            return $this->findByEmail($request);
        } elseif ($request->query('startDate') && $request->query('endDate')) {
            return $this->findByCreatedAt($request);
        } else return 'Wrong query';
    }

    public function findByEmail(Request $request)
    {
        $search_email = $request->query('keywords')."%";
        $user = User::where('email','ilike', $search_email)
            ->paginate(1)
            ->withQueryString();
        return UserResource::collection($user);
    }

    public function findByCreatedAt(Request $request)
    {
        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');
        $userByCreatedDate = User::whereBetween('created_at',[ $startDate, $endDate ])
            ->paginate(1)
            ->withQueryString();

        return UserResource::collection($userByCreatedDate);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateUserRequest $request): UserResource
    {
        $created_user = User::create($request->validated());

        return new UserResource($created_user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return UserResource
     */
    public function show($id)
    {
        return new UserResource(User::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return UserResource
     */
    public function update(UpdateUserRequest $request,User $user)
    {
        $user->update($request->validated());

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $deleted_user_id = $user->id;
        $user->delete();

        return response( "Пользователь с ID № {$deleted_user_id} удалена!", Response::HTTP_NO_CONTENT);
    }
}
