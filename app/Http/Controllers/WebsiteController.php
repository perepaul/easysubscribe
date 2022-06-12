<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Traits\LogsError;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\WebsiteResource;

class WebsiteController extends Controller
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
            new WebsiteResource(
                Website::latest()->paginate()
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
            'name' => ['required', 'string', 'unique:websites'],
            'url' => ['required', 'url'],
        ]);
        DB::beginTransaction();
        try {
            Website::create($valid);
            DB::commit();
            return $this->success();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function show(Website $website)
    {
        return $this->success(
            'success',
            new WebsiteResource($website)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Website $website)
    {
        $valid = $request->validate([
            'name' => ['required', 'string', 'unique:websites,name,' . $website->id],
            'url' => ['required', 'url'],
        ]);
        DB::beginTransaction();
        try {
            $website->update($valid);
            DB::commit();
            return $this->success();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function destroy(Website $website)
    {
        $website->users()->detach();
        $website->delete();
        return $this->success();
    }
}
