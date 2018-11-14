<?php

namespace App\Http\Controllers;

use App\Center;
use App\User;
use App\Branch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CentersController extends Controller
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
          $centers = Center::all();
        }else if((Auth::user()->user_role_id<4)){
          $centers = Center::where('center_branch_id',Auth::user()->user_branch_id)->get();
        }else {
          $centers = Center::where('center_user_id',Auth::user()->id)->get();
        }

           return view('centers.index', ['centers'=> $centers]);
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

      if( Auth::check() ){

        if((Auth::user()->user_role_id<3)){

          $users=User::all();
          $branches=Branch::all();


        }else {
          $users=User::where('user_branch_id',Auth::user()->user_branch_id)->get();;
          $branches=Branch::where('branch_id',Auth::user()->user_branch_id)->get();;



        }

           return view('centers.create', ['users'=>$users,'branches'=>$branches]);
      }
      return view('auth.login');
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
          $center = Center::create([
              'center_name' => $request->input('name'),
              'center_address' => $request->input('address'),
              'center_collect_day' => $request->input('collectday'),
              'center_user_id' => $request->input('user'),
              'center_branch_id' => $request->input('branch')

          ]);


          if($center){
              return redirect()->route('centers.show', ['center'=> $center->center_id])
              ->with('success' , 'Center created successfully');
          }

      }

          return back()->withInput()->with('errors', 'Error creating new center');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Center  $center
     * @return \Illuminate\Http\Response
     */
    public function show(Center $center)
    {
      $center = Center::find($center->center_id);

      return view('centers.show', ['center'=>$center]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Center  $center
     * @return \Illuminate\Http\Response
     */
    public function edit(Center $center)
    {
      $center = Center::find($center->center_id);

      return view('centers.edit', ['center'=>$center]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Center  $center
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Center $center)
    {
      $centerUpdate = Center::where('center_id', $center->center_id)
                             ->update([
                               'center_name' => $request->input('name'),
                               'center_address' => $request->input('address'),
                               'center_collect_day' => $request->input('collectday'),
                               'center_user_id' => $request->input('user'),
                               'center_branch_id' => $request->input('branch')
                             ]);

   if($centerUpdate){
       return redirect()->route('centers.show', ['center'=> $center->center_id])
       ->with('success' , 'Center updated successfully');
   }
   //redirect
   return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Center  $center
     * @return \Illuminate\Http\Response
     */
    public function destroy(Center $center)
    {
      $findCenter = Center::find( $center->center_id);
  if($findCenter->delete()){

          //redirect
          return redirect()->route('centers.index')
          ->with('success' , 'Center deleted successfully');
      }

      return back()->withInput()->with('error' , 'Center could not be deleted');
    }
}
