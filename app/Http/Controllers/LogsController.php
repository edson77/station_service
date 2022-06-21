<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MercurySeries\Flashy\Flashy;

class LogsController extends Controller
{
    public function  __construct(){
        $this->middleware('auth');
    }

    public function index(){

        $jours =  DB::select("SELECT DISTINCT DATE(created_at)  jour FROM logs");
        $auteurs =  DB::select("SELECT DISTINCT  auteur FROM logs");

        // Log::orderby('created_at','DESC')->get();
        $logs = DB::select("SELECT * FROM logs ORDER BY created_at DESC ");

        return view('logs.index',[
            'logs' => $logs,
            'jours' =>$jours,
            'auteurs' => $auteurs
        ]);
    }

    public function show($id){
        $log = Log::find($id);
        return view('logs.show',compact('log'));
    }
    public function search(Request $request){
        if ( empty($request->auteur) AND empty($request->jour))
        {
            Flashy::error("vous devez selectionner au moins un élément");
            return redirect()->back();
        }else{
            if (!empty($request->auteur))
            {
                if (!empty($request->jour))
                {
                    $logs = Log::where('auteur', $request->auteur)
                        ->where('jour',$request->jour)
                        ->get();
                    return view('logs.search', compact('logs'));
                }else{
                    $logs = Log::where('auteur', $request->auteur)
                        ->get();
                    return view('logs.search', compact('logs'));
                }
            }else{
                if (!empty($request->jour))
                {
                    $logs = Log::where('jour',$request->jour)
                        ->get();
                    return view('logs.search', compact('logs'));
                }else{

                    Flashy::error("vous devez selectionner au moins un élément");
                    return redirect()->back();
                }
            }
        }
    }

    public function printLog(){
        $logs = Log::orderBy('created_at', 'desc')->get();


        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'orientation' => 'landscape']);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->setHTMLFooter("
                                <div align='center' style='font-size: 13px'>
                                    <b>PETROLIUM</b> Plateforme de Gestion des stations services designed by <b>Edson Bitjoka </b>.<br>-- Ydé Cameroun -- Tel: (+237) 697878606 
                                </div>
                             ");

        $log = new Log();
        $log->libelle = 'Impression de la liste des logs';
        $log->auteur = Auth::user()->id;
        $log->jour = date('Y-m-d');
        $log->save();

        ob_start();
        echo view('logs.print', compact('logs'));
        $html = ob_get_contents();
        ob_end_clean();

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
