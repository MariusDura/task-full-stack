<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Models\Address;
use App\Models\Company;
use App\Models\User;
use Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ResourceCollection
     */
    public function index()
    {
        $users = User::all();

        return new UserCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return JsonResponse
     */
    public function store(UserStoreRequest $request)
    {
        $address = Address::create([
            'street' => $request['address.street'],
            'suite' => $request['address.suite'],
            'city' => $request['address.city'],
            'zipcode' => $request['address.zipcode'],
            'geo_lat' => $request['address.geo.lat'],
            'geo_lng' => $request['address.geo.lng']
        ]);

        $company = Company::create([
            'name' => $request['company.name'],
            'catch_phrase' => $request['company.catch_phrase'],
            'bs' => $request['company.bs'],
        ]);

        $request->merge([
            'address_id' => $address->id,
            'company_id' => $company->id
        ]);

        $user = User::create($request->all());

        if ($request->imported) {
            return response()->json(['Status' => 200, 'Message' => 'You have successfully imported a new user! (' . $user->name . ')', 'User' => new UserResource($user)]);

        }

        return response()->json(['Status' => 200, 'Message' => 'You have successfully created a new user!', 'User' => new UserResource($user)]);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return UserResource
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        if ($request->email != $user->email) {
            $validator = Validator::make($request->all(), [
                'email' => 'unique:users'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        }

        $address = Address::find($request['address.id']);
        $company = Company::find($request['company.id']);


        $address->update([
            'street' => $request['address.street'],
            'suite' => $request['address.suite'],
            'city' => $request['address.city'],
            'zipcode' => $request['address.zipcode'],
            'geo_lat' => $request['address.geo.lat'],
            'geo_lng' => $request['address.geo.lng']
        ]);

        $company->update([
            'name' => $request['company.name'],
            'catch_phrase' => $request['company.catch_phrase'],
            'bs' => $request['company.bs'],
        ]);

        $user->update($request->all());

        return response()->json(['Status' => 200, 'Message' => 'You have successfully updated "' . $user->name . '" user!', 'User' => new UserResource($user)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user)
    {
        Company::find($user->company_id)->delete();
        Address::find($user->address_id)->delete();

        $user->delete();

        return response()->json(['Status' => 200,
            'Message' => 'User has been successfully deleted!'
        ], 200);
    }
}
