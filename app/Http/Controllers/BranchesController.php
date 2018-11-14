<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Branch;
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if( Auth::check() ){


          $branches = Branch::all();

           return view('branches.index', ['branches'=> $branches]);
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
                return view('branches.create');
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
          $branch = Branch::create([
              'branch_name' => $request->input('name'),
              'branch_address' => $request->input('address'),
              'branch_telephone' => $request->input('telephone'),

          ]);


          if($branch){
              return redirect()->route('branches.show', ['branch'=> $branch->branch_id])
              ->with('success' , 'Branch created successfully');
          }

      }

          return back()->withInput()->with('errors', 'Error creating new branch');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
      $branch = Branch::find($branch->branch_id);

      return view('branches.show', ['branch'=>$branch]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
      $branch = Branch::find($branch->branch_id);

      return view('branches.edit', ['branch'=>$branch]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
      $branchUpdate = Branch::where('branch_id', $branch->branch_id)
                             ->update([
                                     'branch_name'=> $request->input('name'),
                                     'branch_address'=> $request->input('address'),
                                     'branch_telephone'=> $request->input('telephone')
                             ]);

   if($branchUpdate){
       return redirect()->route('branches.show', ['branch'=> $branch->branch_id])
       ->with('success' , 'Branch updated successfully');
   }
   //redirect
   return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
      $findBranch = Branch::find( $branch->branch_id);
  if($findBranch->delete()){

          //redirect
          return redirect()->route('branches.index')
          ->with('success' , 'Branch deleted successfully');
      }

      return back()->withInput()->with('error' , 'Branch could not be deleted');
    }
}
