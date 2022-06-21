<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Consommation;
use App\Models\Log;
use App\Models\Voiture;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MercurySeries\Flashy\Flashy;

class ConsommationController extends Controller
{
    public function  __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $consommations = Consommation::where('deleted',0)
        ->orderby('date_consomation','DESC')->get();

        return view('operations.index',[
            'consommations' => $consommations
        ]);
    }
    public function deleted(){
        $consommations = Consommation::where('deleted',1)
            ->orderby('date_consomation','DESC')->get();

        return view('operations.deleted',[
            'consommations' => $consommations
        ]);
    }

    public function restore($id){

            Consommation::find($id)->update(['deleted' => 0]);
            Flashy::success("la consommation a été restoré avec success");
            return redirect()->back();

        return redirect()->back();

    }

    public function clients(){
        $clients = Client::all();

        return view('operations.clients',[
            'clients' => $clients
        ]);
    }

    public function vehicules(){
        $voitures = Voiture::all();
        return view('operations.vehicules',[
            'voitures' => $voitures
        ]);
    }

    public function show($id){
        $consommations = Consommation::find($id);
        return view('operations.show', compact('consommations'));
    }

    public function printConso(){
        $consomations = Consommation::orderBy('date_consomation', 'desc')->get();

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'orientation' => 'landscape']);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->setHTMLFooter("
                                <div align='center' style='font-size: 13px'>
                                    <b>PETROLIUM</b> Plateforme de Gestion des stations services designed by <b>Edson Bitjoka </b>.<br>-- Ydé Cameroun -- Tel: (+237) 697878606 
                                </div>
                             ");

        $log = new Log();
        $log->libelle = "Impression de la liste des consommations";
        $log->auteur = Auth::user()->id;
        $log->jour = date('Y-m-d');
        $log->save();

        ob_start();
        echo view('operations.printConso', compact('consomations'));
        $html = ob_get_contents();
        ob_end_clean();

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function printConsoId($id){
        $consommations = Consommation::find($id);

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'orientation' => 'landscape']);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->setHTMLFooter("
                                <div align='center' style='font-size: 13px'>
                                    <b>PETROLIUM</b> Plateforme de Gestion des stations services designed by <b>Edson Bitjoka </b>.<br>-- Ydé Cameroun -- Tel: (+237) 697878606 
                                </div>
                             ");

        $log = new Log();
        $log->libelle = "Impression d'une consommations";
        $log->auteur = Auth::user()->id;
        $log->jour = date('Y-m-d');
        $log->save();

        ob_start();
        echo view('operations.printConsoId', compact('consommations'));
        $html = ob_get_contents();
        ob_end_clean();

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
    public function delete($id){

            Consommation::find($id)->update(['deleted' => 1]);
            Flashy::success("la consommation a été supprimé avec success");
            return redirect()->back();
    }
}
