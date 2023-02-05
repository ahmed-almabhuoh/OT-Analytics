<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddNewAdminRequest;
use App\Models\Admin;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    // Validation function
    public function adminValidation($inputs, $rules, $msg = [])
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
        $admins = Admin::paginate();
        return response()->view('backend.admins.index', [
            'admins' => $admins,
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
        return response()->view('backend.admins.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->adminValidation($request->only([
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
            'email' => 'required|email|unique:admins,email',
            'phone' => 'required|string|unique:admins,phone',
            'password' => ['required', 'string', Password::min(6)->letters()->numbers()],
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg'],
            'status' => 'required|boolean',
        ]);
        //
        if (!$validator->fails()) {
            $admin = new Admin();
            $admin->fname = $request->input('fname');
            $admin->lname = $request->input('lname');
            $admin->email = $request->input('email');
            $admin->password = Hash::make($request->input('password'));
            $admin->phone = $request->input('phone');
            $admin->status = $request->input('status') ? 'active' : 'draft';
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $image_path = $file->store('/admins', 'public');
                $admin->img = $image_path;
            }
            $isCreated = $admin->save();

            return response()->json([
                'message' => $isCreated ? 'Admin added successfully' : 'Failed to add admin, please try again!',
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail(Crypt::decrypt($id));
        //
        return response()->view('backend.admins.edit', [
            'admin' => $admin,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail(Crypt::decrypt($id));
        $validator = $this->adminValidation($request->only([
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
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'phone' => 'required|string|unique:admins,phone,' . $admin->id,
            // 'password' => ['required', 'string', Password::min(6)->letters()->numbers()],
            // 'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg'],
            'status' => 'required|boolean',
        ]);
        //
        if (!$validator->fails()) {
            $admin->fname = $request->input('fname');
            $admin->lname = $request->input('lname');
            $admin->email = $request->input('email');
            // $admin->password = Hash::make($request->input('password'));
            $admin->phone = $request->input('phone');
            $admin->status = $request->input('status') ? 'active' : 'draft';
            if ($request->hasFile('image')) {
                Storage::delete($admin->img);
                $file = $request->file('image');
                $image_path = $file->store('/admins', 'public');
                $admin->img = $image_path;
            }
            $isUpdated = $admin->save();

            return response()->json([
                'message' => $isUpdated ? 'Admin updated successfully' : 'Failed to update admin, please try again!',
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
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::findOrFail(Crypt::decrypt($id));
        $admin_img = $admin->img;
        //
        if ($admin->delete()) {
            Storage::delete($admin_img);
            return response()->json([
                'icon' => 'success',
                'title' => 'Deleted!',
                'text' => 'Admin deleted successfully.',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => 'Failed!',
                'text' => 'Failed to delete admin, please try again!',
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
