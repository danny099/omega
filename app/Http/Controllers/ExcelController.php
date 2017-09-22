<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
// use App\Item;
use DB;
use Excel;

class ExcelController extends Controller
{
  public function importExcel(Request $request)
  {
    $file = Input::file('import_file');
    dd($file);
    die();
    // return Excel::load($file, function($reader) {
    //   // Getting all results
    //   // $results = $reader->get();
    //   // dd($results);
    //   // $results = $reader->get()->toArray();
    //   //   dd($results);
    //   //   die();
    //   $var = Excel::selectSheets('Hoja1')->load();
    //
    //   dd($var->toArray());
    //   die();
    //   // echo '<pre>';print_r($arreglo );
    //   // echo '</pre>';
    //
    // });

      // return $result = Excel::selectSheetsByIndex(0)->load($file, function($reader) { $reader->noHeading(); })->get();
  }
}
