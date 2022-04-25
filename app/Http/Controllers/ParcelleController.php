<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parcelle;
use Datatables;

class ParcelleController extends Controller
{
    //

    public function index()
{
if(request()->ajax()) {
return datatables()->of(Parcelle::select('*'))
->addColumn('action', 'parcelles.action')
->rawColumns(['action'])
->addIndexColumn()
->make(true);
}
return view('parcelles.index');
}
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
return view('parcelles.create');
}
/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
$request->validate([
'Par_Nom' => 'required',
'Par_Lieu' => 'required',
'Par_Prop' => 'required',
'Par_Superficie' => 'required'

]);
$parcelle = new Parcelle;
$parcelle->Par_Nom = $request->Par_Nom;
$parcelle->Par_Lieu = $request->Par_Lieu;
$parcelle->Par_Prop = $request->Par_Prop;
$parcelle->Par_Superficie = $request->Par_Superficie;
$parcelle->save();

return redirect()->route('parcelles.index')
->with('success','Parcelle has been created successfully.');
}
/**
* Display the specified resource.
*
* @param  \App\Parcelle  $company
* @return \Illuminate\Http\Response
*/
public function show(Parcelle $parcelle)
{
return view('parcelles.show',compact('parcelle'));
} 
/**
* Show the form for editing the specified resource.
*
* @param  \App\Parcelle  $company
* @return \Illuminate\Http\Response
*/
public function edit(Parcelle $parcelle)
{
return view('parcelles.edit',compact('parcelle'));
}
/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  \App\Parcelle  $company
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
$request->validate([
'Par_Nom' => 'required',
'Par_Lieu' => 'required',
'Par_Prop' => 'required',
'Par_Superficie' => 'required',
]);
$parcelle = Parcelle::find($id);
$parcelle->Par_Nom = $request->Par_Nom;
$parcelle->Par_Lieu = $request->Par_Lieu;
$parcelle->Par_Prop = $request->Par_Prop;
$parcelle->Par_Superficie = $request->Par_Superficie;
$parcelle->save();
return redirect()->route('parcelles.index')
->with('success','Parcelle Has Been updated successfully');
}
/**
* Remove the specified resource from storage.
*
* @param  \App\Parcelle  $parcelle
* @return \Illuminate\Http\Response
*/
public function destroy(Request $request)
{
$com = Parcelle::where('id',$request->id)->delete();
return Response()->json($com);
}
}
