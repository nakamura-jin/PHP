<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
  public function index(Request $request)
  {
    $items = DB::table('peaple')->orderBy('age', 'asc')->get();
    return view('index', ['items' => $items]);
  }

  public function show(Request $request)
  {
    $page = $request->page;
    $items = DB::table('peaple')->offset($page * 3)->limit(3)->get();
    return view('show', ['items' => $items]);
  }

  public function add(Request $request)
  {
    return view('add');
  }

  public function create(Request $request)
  {
    $param = [
      'name' => $request->name,
      'age' => $request->age
    ];
    return redirect('/h');
  }

  public function edit(Request $request)
  {
    $item = DB::table('peaple')->where('id', $request->id)->first();
    return view('edit', ['form => $item']);
  }

  public function update(Request $request)
  {
    $param = [
      'name' => $request->name,
      'age' => $request->age
    ];
    DB::table('peaple')->where('id', $request->id)->update($param);
    return redirect('/');
  }

  public function remove(Request $request)
  {
    DB::table('peaple')->where('id', $request->id)->delete();
    return redirect('/');
  }
}
