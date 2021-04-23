<?php

namespace App\Http\Controllers;

use App\Models\Organziation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
{
    
    public function index()
    {
      


        $organizations = [];
        if (request()->ajax()) {
            $organizations = Organziation::all();
            // return datatables()->of($organizations)->addIndexColumn()->make(true);
        }

        return view('organizations.index', compact('organizations'));
    }





    public function store(Request $request)
    {
        $request->validate([
            'author' => 'required',
            'title' => 'required',
            'content' => 'required',

        ]);
        $organizations = Organziation::create($request->all());
        return redirect()->route('organizations.index');
    }


    public function create()
    {
        return view('organizations.create');
    }



    public function edit(Organziation $organization)
    {

        return view('organizations.edit', compact('organization'));
    }


    public function update(Request $request, Organziation $organization)
    {
        $request->validate([
            'author' => 'required',
            'title' => 'required',
            'content' => 'required',

        ]);

        $organization->update($request->all());
        return redirect()->route('organizations.index');
    }


    public function destroy(Organziation $organization)
    {

        $datafound = DB::table('products')->where('organization_id', '=', $organization->id)->get();
        if ($datafound->count() > 0) {
            $msg =  "You Can't Delete this organization ";
            return view('organizations.index', compact('msg'));
        }
        $organization->delete();
        return redirect()->route('organizations.index');
    }



    public function deleteOrganization(int $id)
    {
        $organization = Organziation::where('id', '=', $id)->first();

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