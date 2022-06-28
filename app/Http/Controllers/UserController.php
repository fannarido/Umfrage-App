<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * PUT api/users
     * update user
     */
    public function update(User $user, Request $request)
    {
        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->roles = $request->roles;
            $user->update();
            return response()->json([
                "success" => true,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * DELETE api/admin/user/{user}
     * to delete a user
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json([
                "success" => true,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * GET api/admin/user/{user}
     * to get a user
     */
    public function show(User $user)
    {
        try {
            return response()->json([
                "success" => true,
                "data" => $user,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
