<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\LogsError;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use LogsError, ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->success(
            'success',
            new UserResource(
                User::latest()->paginate()
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed']
        ]);
        DB::beginTransaction();
        $valid['password'] = Hash::make($valid['password']);
        try {
            User::create($valid);
            DB::commit();
            return $this->success('user created');
        } catch (\Throwable $th) {
            DB::releBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->success(
            'User fetched',
            new UserResource($user)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $valid = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            //  User might not change their password will updating the their profile,
            //  so make it nullable
            'password' => ['nullable', 'confirmed']
        ]);
        DB::beginTransaction();
        try {
            $user->update($valid);
            DB::commit();
            return $this->success('user updated');
        } catch (\Throwable $th) {
            DB::releBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->websites()->detach();
        $user->delete();
        return $this->success('user deleted');
    }

    /**
     * Subscribes a user to a website
     * @param \Illuminate\Http\Request $$request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */

    public function subscribe(Request $request, User $user)
    {
        $websites = $request->validate([
            'websites' => ['required'],
        ]);

        DB::beginTransaction();

        try {
            $user->websites()->attach($websites);
            DB::commit();
            return $this->success('subscribed to webtsite(s)');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }


    /**
     * Unsubscribes a user from a website
     * @param \Illuminate\Http\Request $$request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */

    public function unsubscribe(Request $request, User $user)
    {
        $websites = $request->validate([
            'websites' => ['required'],
        ]);

        DB::beginTransaction();
        try {
            $user->websites()->detach($websites);
            DB::commit();
            return $this->success('subscribed to webtsite(s)');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
