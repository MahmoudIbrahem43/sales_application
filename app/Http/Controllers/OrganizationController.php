<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
{


    //get all data
    public function index()
    {
         
        $organizations =[];
        if (request()->ajax()){
            $organizations = Organization::all();
            return datatables()->of($organizations)->addIndexColumn()->make(true);
        }
        return view('organizations.index', compact('organizations'));
    }




    //insert data 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'employees' => 'required',

        ]);
        $organizations = Organization::create($request->all());
        return redirect()->route('organizations.index');
    }


    //call view create form
    public function create()
    {
        return view('organizations.create');
    }


    //call view edit form
    public function edit(Organization $organization)
    {
        return view('organizations.edit', compact('organization'));
    }

    //update data
    public function update(Request $request, Organization $organization)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'employees' => 'required',

        ]);

        $organization->update($request->all());
        return redirect()->route('organizations.index');
    }

    //delete data
    public function destroy(Organization $organization)
    {
        $datafound = DB::table('products')->where('organization_id', '=', $organization->id)->get();
        if ($datafound->count() > 0) {
            $msg =  "You Can't Delete this organization ";
            return view('organizations.index', compact('msg'));
        }
        $organization->delete();
        return redirect()->route('organizations.index');
    }


    //custome delete function
    public function deleteOrganization(int $id)
    {
        $organization = Organization::where('id', '=', $id)->first();
        $result = [
            $msg = ""
        ];
        if ($organization == null) {
            $result["msg"] =  "organization Not found !";
            return $result;
        }
        $datafound = DB::table('products')->where('organization_id', '=', $organization->id)->get();

        if ($datafound->count() > 0) {
            $result["msg"] =  "You Can't Delete this organization delete the product first";
            return $result;
        }
        $organization->delete();
        return $result;
    }
}
