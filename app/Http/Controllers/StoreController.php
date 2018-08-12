<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\StoreDomain;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:stores,name',
            'short_description' => 'required|max:150',
            'description' => 'required',
            'domain' => 'string|unique:store_domains,domain'
        ]);

        // TODO: Probably should actually store the store against a user.

        $store = Store::query()->create([
            'name' => $request->input('name'),
            'short_description' => $request->input('short_description'),
            'description' => $request->input('description')
        ]);

        // TODO: Check that the domain is actually active and valid before inserting into the database.

        $domain = StoreDomain::query()->create([
            'store_id' => $store->id,
            'domain' => $request->input('domain')
        ]);

        return $store;
    }
}