<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        dd($request->validated());
    }

   public function update(UpdateUserRequest $request)
   {
        dd($request->validated());
   }
}
