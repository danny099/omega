<?php

namespace App\Http\Controllers;
use App\Otrosi;
use Session;
use App\Administrativa;
use Illuminate\Http\Request;

class OtrosiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // $otrosis=Otrosi::all();
      //
      // return view('otrosi.index',compact('otrosis'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $otrosi = Otrosi::all();
      $codigos = Administrativa::all();

      return view('otrosi.create',compact('codigos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $input = $request->all();
      $datos['valor'] = str_replace(',','',$request->valor);
      $datos['iva'] = str_replace(',','',$request->iva);
      $datos['valor_tot'] = str_replace(',','',$request->valor_tot);
      $datos['detalles'] = ucfirst(mb_strtolower($request->detalles));
      $datos['administrativa_id'] = $request->administrativa_id;

      if ($request->recuerdame == 1) {
        $datos['recuerdame'] = 1;
      }else {
        $datos['recuerdame'] = 0;

      }

      $id = $request->administrativa_id;


      Otrosi::create($datos);

      $other = Otrosi::all();
      $last_id = $other->last()->id;
      $reg_otro = Otrosi::find($last_id);
      $administrativa = Administrativa::find($id);

      $administrativa->contador_otro = $administrativa->contador_otro + $request->recuerdame;
      $administrativa->save();

      $total = $administrativa->saldo + $reg_otro->valor_tot;
      $administrativa->saldo = $total;
      $administrativa->save();

      $nuevo_total = $administrativa->valor_total_contrato + $reg_otro->valor_tot;
      $administrativa->valor_total_contrato = $nuevo_total;
      $administrativa->save();

      Session::flash('message', 'Otro sí creado!!');
      Session::flash('class', 'success');
      return redirect()->route('otrosi.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $ide = Administrativa::find($id);
      $otrosis = Otrosi::where('otrosi.administrativa_id', '=', $id)->get();
      return view('otrosi.index',compact('otrosis','id','ide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $input = $request->all();
      $datos['valor'] = str_replace(',','',$request->valor);
      $datos['iva'] = str_replace(',','',$request->iva);
      $datos['valor_tot'] = str_replace(',','',$request->valor_tot);
      $datos['detalles'] = ucfirst(mb_strtolower($request->detalles));
      $datos['recuerdame'] = $request->recuerdame;
      $otrosi = Otrosi::findOrFail($id);
      $administrativa = Administrativa::findOrFail($otrosi->administrativa_id);

      if ($otrosi->valor_tot == $datos['valor_tot']) {

        if ($datos['recuerdame'] == 0) {


          if ($otrosi->recuerdame == 1) {

            $administrativa->contador_otro = $administrativa->contador_otro - 1;
            $administrativa->contador_otro = $administrativa->contador_otro + $datos['recuerdame'];

            $administrativa->save();

          }

          if ($otrosi->recuerdame == 0) {

            $administrativa->contador_otro = $administrativa->contador_otro + $datos['recuerdame'];
            $administrativa->save();

          }
        }else {
          if ($otrosi->recuerdame == 1) {

            $administrativa->contador_otro = $administrativa->contador_otro - $datos['recuerdame'];
            $administrativa->contador_otro = $administrativa->contador_otro + $datos['recuerdame'];
            $administrativa->save();

            // $administrativa->contador_otro = $administrativa->contador_fac + $datos['recuerdame'];
            // $administrativa->save();
          }
          if ($otrosi->recuerdame == 0) {

            $administrativa->contador_otro = $administrativa->contador_otro + $datos['recuerdame'];
            $administrativa->save();

          }

        }

        $otrosi->update($datos);

        Session::flash('message', 'Otro sí editado!');
        Session::flash('class', 'success');
        return redirect()->route('administrativas.index');
      }

      if ($administrativa->saldo < $otrosi->valor_tot) {
        Session::flash('message', 'El otro sí no se puede editar ya que se efectuaron los pagos');
        Session::flash('class', 'danger');
        return redirect()->route('administrativas.index');
      }



      if ($datos['recuerdame'] == 0) {


        if ($otrosi->recuerdame == 1) {

          $administrativa->contador_otro = $administrativa->contador_otro - 1;
          $administrativa->contador_otro = $administrativa->contador_otro + $datos['recuerdame'];
          $administrativa->save();

        }

        if ($otrosi->recuerdame == 0) {

          $administrativa->contador_otro = $administrativa->contador_otro + $datos['recuerdame'];
          $administrativa->save();

        }
      }else {
        if ($otrosi->recuerdame == 1) {

          $administrativa->contador_otro = $administrativa->contador_otro - $datos['recuerdame'];
          $administrativa->contador_otro = $administrativa->contador_otro + $datos['recuerdame'];
          $administrativa->save();

        }
        if ($otrosi->recuerdame == 0) {

          $administrativa->contador_otro = $administrativa->contador_otro + $datos['recuerdame'];
          $administrativa->save();

        }

      }


      if ($administrativa->valor_total_contrato > $datos['valor_tot'] ) {

        $valor1 = $administrativa->valor_total_contrato - $otrosi->valor_tot;
        $valor2 = $valor1 + $datos['valor_tot'];

        $administrativa->valor_total_contrato = $valor2;
        $administrativa->save();

      }else {
        $valor1 = $otrosi->valor_tot - $administrativa->valor_total_contrato;
        $valor2 = $valor1 + $datos['valor_tot'];
        $administrativa->valor_total_contrato = $valor2;
        $administrativa->save();
      }


      if ( $administrativa->saldo >= 0) {
        if ($administrativa->saldo > $datos['valor_tot']) {
          $resta = $administrativa->saldo - $otrosi->valor_tot;
          $nuevo_saldo = $resta + $datos['valor_tot'];
          $administrativa->saldo = $nuevo_saldo;
          $administrativa->save();
        }
        else {
          $resta =$otrosi->valor_tot - $administrativa->saldo ;
          $nuevo_saldo = $resta + $datos['valor_tot'];
          $administrativa->saldo = $nuevo_saldo;
          $administrativa->save();
        }

      }

      $otrosi->update($datos);

      Session::flash('message', 'Otro sí editado!');
      Session::flash('class', 'success');
      return redirect()->route('administrativas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $otrosi = Otrosi::findOrFail($id);
      $administrativas = Administrativa::findOrFail($otrosi->administrativa_id);

      if ($administrativas->saldo < $otrosi->valor_tot) {
        Session::flash('message', 'El otro sí no se puede eliminar ya que se efectuaron los pagos');
        Session::flash('class', 'danger');
        return redirect()->route('administrativas.index');
      }

      if ($administrativas->contador_otro > 0) {
        $administrativas->contador_otro =$administrativas->contador_otro - 1;
        $administrativas->save();
      }

      if ($administrativas->saldo > 0) {
        if ($administrativas->saldo >= $otrosi->valor_tot) {
          $nuevo_saldo = $administrativas->saldo - $otrosi->valor_tot;
          $administrativas->saldo = $nuevo_saldo;
          $administrativas->save();

          $nuevo = $administrativas->valor_total_contrato - $otrosi->valor_tot;
          $administrativas->valor_total_contrato = $nuevo;
          $administrativas->save();

          $otrosi->delete();

          Session::flash('message', 'Otro sí eliminado');
          Session::flash('class', 'danger');
          return redirect()->route('administrativas.index');

        }else{
          Session::flash('message', 'No se puede eliminar el otro sí por pagos echos anteriormente');
          Session::flash('class', 'danger');
          return redirect()->route('administrativas.index');
        }

      }

      if ($administrativas->saldo == 0) {
        Session::flash('message', 'No se puede eliminar el otro sí por pagos echos anteriormente');
        Session::flash('class', 'danger');
        return redirect()->route('administrativas.index');
      }

      // if ($administrativas->saldo < $otrosi->valor_tot) {
      //   Session::flash('message', 'El otro sí no se puede eliminar ya que se efectuaron los pagos');
      //   Session::flash('class', 'danger');
      //   return redirect()->route('administrativas.index');
      // }
      //
      // if ($administrativas->contador_otro > 0) {
      //   $administrativas->contador_otro = $administrativas->contador_otro - 1;
      //   $administrativas->save();
      // }
      //
      // if ($administrativas->saldo > 0) {
      //   if ($administrativas->saldo >= $otrosi->valor_tot) {
      //     $nuevo_saldo = $administrativas->saldo - $otrosi->valor_tot;
      //     $administrativas->saldo = $nuevo_saldo;
      //     $administrativas->save();
      //   }else {
      //     // $nuevo_saldo = $otrosi->valor_tot - $administrativas->saldo;
      //     // $administrativas->saldo = $nuevo_saldo;
      //     // $administrativas->save();
      //     Session::flash('message', 'No se puede eliminar el otro si por que se realizaron pagos');
      //     Session::flash('class', 'danger');
      //     return redirect()->route('administrativas.index');
      //   }
      //
      //   if ($administrativas->valor_total_contrato > $otrosi->valor_tot) {
      //     $nuevo_total = $administrativas->valor_total_contrato - $otrosi->valor_tot;
      //     $administrativas->valor_total_contrato = $nuevo_total;
      //     $administrativas->save();
      //   }else {
      //     Session::flash('message', 'No se puede eliminar el otro si por que se realizaron pagos');
      //     Session::flash('class', 'danger');
      //     return redirect()->route('administrativas.index');
      //   }
      // }else {
      //   if ($administrativas->valor_total_contrato > $otrosi->valor_tot) {
      //     $nuevo_total = $administrativas->valor_total_contrato - $otrosi->valor_tot;
      //     $administrativas->valor_total_contrato = $nuevo_total;
      //     $administrativas->save();
      //   }else {
      //     echo "hola";
      //     }
      //
      //     $otrosi->delete();
      //
      //     Session::flash('message', 'Otro sí eliminado');
      //     Session::flash('class', 'danger');
      //     return redirect()->route('administrativas.index');
      //
      // }

    }
}
