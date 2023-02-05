<?php

namespace App\Http\Controllers;

use App\Models\Contributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class ContributorController extends Controller
{
    // Validation function
    public function contributorsValidate($inputs, $rules, $msg = [])
    {
        return Validator($inputs, $rules, $msg);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contributors = Contributor::paginate();
        return response()->view('backend.contributors.index', [
            'contributors' => $contributors,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('backend.contributors.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->contributorsValidate($request->only([
            'fname',
            'lname',
            'email',
            'phone',
            'password',
            'status',
            'image',
        ]), [
            'fname' => 'required|string|min:3|max:15',
            'lname' => 'required|string|min:3|max:15',
            'email' => 'required|email|unique:contributors,email',
            'phone' => 'required|string|unique:contributors,phone',
            'password' => ['required', 'string', Password::min(6)->letters()->numbers()],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg'],
            'status' => 'required|boolean',
        ]);
        //
        if (!$validator->fails()) {
            $contributor = new Contributor();
            $contributor->fname = $request->input('fname');
            $contributor->lname = $request->input('lname');
            $contributor->email = $request->input('email');
            $contributor->password = Hash::make($request->input('password'));
            $contributor->phone = $request->input('phone');
            $contributor->status = $request->input('status') ? 'active' : 'draft';
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $image_path = $file->store('/contributors', 'public');
                $contributor->img = $image_path;
            }
            $isCreated = $contributor->save();

            return response()->json([
                'message' => $isCreated ? 'Contributor added successfully' : 'Failed to add contributor, please try again!',
            ], $isCreated ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contributor  $contributor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contributor = Contributor::findOrFail(Crypt::decrypt($id));
        //
        return response()->view('backend.contributors.edit', [
            'contributor' => $contributor,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contributor  $contributor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contributor = Contributor::findOrFail(Crypt::decrypt($id));
        //
        return response()->view('backend.contributors.edit', [
            'contributor' => $contributor,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contributor  $contributor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contributor = Contributor::findOrFail(Crypt::decrypt($id));
        $validator = $this->contributorValidation($request->only([
            'fname',
            'lname',
            'email',
            'phone',
            // 'password',
            'status',
            'image',
        ]), [
            'fname' => 'required|string|min:3|max:15',
            'lname' => 'required|string|min:3|max:15',
            'email' => 'required|email|unique:contributors,email,' . $contributor->id,
            'phone' => 'required|string|unique:contributors,phone,' . $contributor->id,
            // 'password' => ['required', 'string', Password::min(6)->letters()->numbers()],
            // 'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg'],
            'status' => 'required|boolean',
        ]);
        //
        if (!$validator->fails()) {
            $contributor->fname = $request->input('fname');
            $contributor->lname = $request->input('lname');
            $contributor->email = $request->input('email');
            // $contributor->password = Hash::make($request->input('password'));
            $contributor->phone = $request->input('phone');
            $contributor->status = $request->input('status') ? 'active' : 'draft';
            if ($request->hasFile('image')) {
                Storage::delete($contributor->img);
                $file = $request->file('image');
                $image_path = $file->store('/contributors', 'public');
                $contributor->img = $image_path;
            }
            $isUpdated = $contributor->save();

            return response()->json([
                'message' => $isUpdated ? 'Contributor updated successfully' : 'Failed to update contributor, please try again!',
            ], $isUpdated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json([
                'message' => $validator->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contributor  $contributor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contributor = Contributor::findOrFail(Crypt::decrypt($id));
        $contributor_img = $contributor->img;
        //
        if ($contributor->delete()) {
            Storage::delete($contributor_img);
            return response()->json([
                'icon' => 'success',
                'title' => 'Deleted!',
                'text' => 'Contributor deleted successfully.',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Failed to delete contributor, please try again!',
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
