<?php

namespace App\Http\Controllers;

use App\Model\Phases;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\phase;

class PhasesController extends Controller
{

  /**
   * Create a new AuthController instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('jwt');
      $this->middleware('isAdmin', ['except' => ['seePhase']]);
  }

  public function seePhase(){
    return phase::collection(Phases::get());
  }

  public function createPhase(Request $request){

    $this->validate($request,[
      'name' => 'required|string'
    ]);

    Phases::create($request->all());

    return response()->json(['status' => 'created'],200);

  }

  public function deletePhase(Phases $phase){

    $phase->delete();
    return response()->json(['status' => 'deleted'],200);

  }

}
