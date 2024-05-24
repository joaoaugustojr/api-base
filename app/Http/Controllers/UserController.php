<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Response;

class UserController extends Controller
{
    use HttpResponses;

    public function index()
    {
        $user = User::paginate();
        return UserResource::collection($user);
    }

    public function store(StoreUpdateUserRequest $request)
    {
        $data = $request->validated();
        $data["password"] = bcrypt($data["password"]);

        $user = User::create($data);

        return new UserResource($user);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    public function update(StoreUpdateUserRequest $request, $id)
    {
        $data = $request->validated();

        if ($request->password) {
            $data["password"] = bcrypt($request->password);
        }

        $user = User::findOrFail($id);
        $user->update($data);

        return new UserResource($user);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return $this->response('Success', Response::HTTP_NO_CONTENT);
    }
}
