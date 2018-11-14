<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Support\Facades\Auth;
use App\Center;
use App\Branch;
use App\Customer;
use App\Http\Controllers\GroupsController;
use Illuminate\Http\Request;

class GroupsController extends Controller
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
          $groups = Group::all();
        }else if((Auth::user()->user_role_id<4)){
          $groups = Group::where('group_center_id',Center::where('center_branch_id',Auth::user()->branch_id)->center_id)->get();
        }else {
          $groups = Group::where('group_center_id',Center::where('center_user_id',Auth::user()->id)->center_id)->get();
        }

           return view('groups.index', ['groups'=> $groups]);
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
          $centers = Center::all();
          $customers=Customer::all();
        }else if((Auth::user()->user_role_id<4)){
          $centers = Center::where('center_branch_id',Auth::user()->branch_id)->get();
          $customers=Customer::where('customer_branch_id',Auth::user()->branch_id)->get();
        }else {
          $centers = Center::where('center_user_id',Auth::user()->id)->get();
          $customers=Customer::where('customer_center_id',Center::where('center_branch_id',Auth::user()->branch_id)->branch_center_id)->get();

        }

           return view('groups.create', ['centers'=> $centers,'customers'=>$customers]);
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
        $c1=$request->input('cust1');
        $c2=$request->input('cust2');
        $c3=$request->input('cust3');

          $group = Group::create([
            'group_center_id' => $request->input('centerid')
          ]);



          app('App\Http\Controllers\CustomersController')->grouped(Customer::find($c1),$group->group_id);
          app('App\Http\Controllers\CustomersController')->grouped(Customer::find($c2),$group->group_id);
          app('App\Http\Controllers\CustomersController')->grouped(Customer::find($c3),$group->group_id);




          if($group){
              return redirect()->route('groups.show', ['group'=> $group->group_id])
              ->with('success' , 'Group created successfully');
          }

      }

          return back()->withInput()->with('errors', 'Error creating new group');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
      $group = Group::find($group->group_id);

      return view('groups.show', ['group'=>$group]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
    if(Auth::check()){
      $group = Group::find($group->group_id);

      if((Auth::user()->user_role_id<3)){
        $centers = Center::all();
        $customers=Customer::all();
      }else if((Auth::user()->user_role_id<4)){
        $centers = Center::where('center_branch_id',Auth::user()->branch_id)->get();
        $customers=Customer::where('customer_branch_id',Auth::user()->branch_id)->get();
      }else {
        $centers = Center::where('center_user_id',Auth::user()->id)->get();
        $customers=Customer::where('customer_center_id',Center::where('center_branch_id',Auth::user()->branch_id)->branch_center_id)->get();

      }

         return view('groups.edit', ['group'=>$group,'centers'=> $centers,'customers'=>$customers]);
    }
    return view('auth.login');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
      $c1= $request->input('c1');
      $c1= $request->input('c2');
      $c1= $request->input('c3');

      $c1= $request->input('cust1');
      $c1= $request->input('cust2');
      $c1= $request->input('cust3');

      $groupUpdate = Group::where('group_id', $group->group_id)
                             ->update([
                               'group_customer_id1' => $c4,
                               'group_customer_id2' => $c5,
                               'group_customer_id3' => $c6,
                               'group_center_id' => $request->input('centerid')
                             ]);
                             app('App\Http\Controllers\CustomersController')->ungrouped(Customer::find($c1));
                             app('App\Http\Controllers\CustomersController')->ungrouped(Customer::find($c2));
                             app('App\Http\Controllers\CustomersController')->ungrouped(Customer::find($c3));


                             app('App\Http\Controllers\CustomersController')->grouped(Customer::find($c4));
                             app('App\Http\Controllers\CustomersController')->grouped(Customer::find($c5));
                             app('App\Http\Controllers\CustomersController')->grouped(Customer::find($c6));


   if($groupUpdate){
       return redirect()->route('groups.show', ['group'=> $group->group_id])
       ->with('success' , 'Group updated successfully');
   }
   //redirect
   return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
      $findGroup = Group::find( $group->group_id);
  if($findGroup->delete()){

          //redirect
          return redirect()->route('groups.index')
          ->with('success' , 'Group deleted successfully');
      }

      return back()->withInput()->with('error' , 'Group could not be deleted');

    }
}
