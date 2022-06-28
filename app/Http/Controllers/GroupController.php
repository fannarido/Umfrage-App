<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupResource;
use App\Models\Group;
use App\Traits\Base64;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GroupController extends Controller
{
    use Base64;
    public function __construct()
    {
        $this->middleware("auth:api")->only("store", "update");
    }

    /**
     *  GET api/groups
     *  to get all groups
     */
    public function index(Request $request)
    {
        try {
            if ($request->search && !$request->dateTime) {
                $groups = Group::where(
                    "name",
                    "LIKE",
                    "%{$request->search}%"
                )->get();
            }
            if ($request->dateTime && !$request->search) {
                $groups = Group::where("date", $request->dateTime)->get();
            }
            if ($request->search && $request->dateTime) {
                $groups = Group::where("name", "LIKE", "%{$request->search}%")
                    ->where("date", $request->dateTime)
                    ->get();
            }
            if (!$request->search && !$request->dateTime) {
                $groups = Group::all();
            }
            return response()->json([
                "success" => true,
                "data" => GroupResource::collection($groups),
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  GET api/groups
     *  to get all groups
     */
    public function groupIndex(Request $request)
    {
        try {
            $group = Group::find($request->group_id);
            return response()->json([
                "success" => true,
                "data" => $group,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
    /**
     *  POST api/groups
     *  to create a new group
     */
    public function store(Request $request)
    {
        request()->validate([
            "name" => "required|unique:groups",
            "dateTime" => "required",
        ]);
        try {
            $group = new Group();
            $group->name = $request->name;
            $group->date = $request->dateTime;
            $group->slug = Str::slug($request->name);
            $group->save();
            return response()->json([
                "success" => true,
                "data" => $group,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  GET api/categories/{category}
     *  to show a category
     */
    public function show(Group $group, Request $request)
    {
        try {
            return response()->json([
                "success" => true,
                "data" => new GroupResource($group),
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     *  PUT/PATCH api/categories/{category}
     *  to update a category
     */
    public function update(Request $request)
    {
        try {
            $group = Group::find($request->id);
            $group->name = $request->name;
            $group->date = $request->date;
            $group->update();
            return response()->json([
                "success" => true,
                "data" => $group,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }

    /**
     * DELETE api/categories/{category}
     * to delete a category
     */
    public function destroy(Request $request)
    {
        try {
            Group::find($request->groupId)->delete();
            return response()->json([
                "success" => true,
            ]);
        } catch (Exception $e) {
            return response($e->getMessage(), 500);
        }
    }
}
