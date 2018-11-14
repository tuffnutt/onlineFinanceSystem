<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if( Auth::check() ){

        if((Auth::user()->user_role_id<3)){
          $users = User::all();
        }else{
          $userd = User::where('id',Auth::user()->id)->get();
        }
           return view('users.index', ['users'=> $users]);
      }
      return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(Auth::check()){
          $user = User::create([

            'name'=> $request->input('name'),
            'email'=> $request->input('email'),
            'password'=> $request->input('password'),

            'user_first_name'=> $request->input('firstname'),
            'user_address'=> $request->input('address'),
            'user_nic'=> $request->input('nic'),
            'user_mobile'=> $request->input('mobile'),
            'user_landline'=> $request->input('landline'),
            'user_birthday'=> $request->input('birthday'),
            'user_marital_status'=> $request->input('marital'),
            'user_role_id'=> $request->input('role'),
            'user_branch_id'=> $request->input('branch')


          ]);


          if($user){
              return redirect()->route('users.show', ['user'=> $user->id])
              ->with('success' , 'User created successfully');
          }

      }

          return back()->withInput()->with('errors', 'Error creating new user');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
      $user = User::find($user->id);

      return view('users.show', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
      $user = User::find($user->id);

      return view('users.edit', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
      $userUpdate = User::where('id', $user->id)
                             ->update([



                               'user_first_name'=> $request->input('firstname'),
                               'user_address'=> $request->input('address'),
                               'user_nic'=> $request->input('nic'),
                               'user_mobile'=> $request->input('mobile'),
                               'user_landline'=> $request->input('landline'),
                               'user_birthday'=> $request->input('birthday'),
                               'user_marital_status'=> $request->input('marital'),
                               'user_role_id'=> $request->input('role'),
                               'user_branch_id'=> $request->input('branch')

                             ]);

   if($userUpdate){
       return redirect()->route('users.show', ['user'=> $user->id])
       ->with('success' , 'User updated successfully');
    }
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        $findUser = User::find( $user->id);
    if($findUser->delete()){

            //redirect
            return redirect()->route('users.index')
            ->with('success' , 'User deleted successfully');
        }

        return back()->withInput()->with('error' , 'User could not be deleted');

    }
}
