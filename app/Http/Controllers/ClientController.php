<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Consommation;
use App\Models\Log;
use App\Models\Voiture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MercurySeries\Flashy\Flashy;

class ClientController extends Controller
{
    public function printClient(){
        $clients = Client::all();

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'orientation' => 'landscape']);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->setHTMLFooter("
                                <div align='center' style='font-size: 13px'>
                                    <b>PETROLIUM</b> Plateforme de Gestion des stations services designed by <b>Edson Bitjoka </b>.<br>-- Ydé Cameroun -- Tel: (+237) 697878606 
                                </div>
                             ");

        $log = new Log();
        $log->libelle = "Impression de la liste des clients";
        $log->auteur = Auth::user()->id;
        $log->jour = date('Y-m-d');
        $log->save();

        ob_start();
        echo view('operations.printClients', compact('clients'));
        $html = ob_get_contents();
        ob_end_clean();

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function printVehicule(){
        $voitures = Voiture::all();
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'orientation' => 'landscape']);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->setHTMLFooter("
                                <div align='center' style='font-size: 13px'>
                                    <b>PETROLIUM</b> Plateforme de Gestion des stations services designed by <b>Edson Bitjoka </b>.<br>-- Ydé Cameroun -- Tel: (+237) 697878606 
                                </div>
                             ");

        $log = new Log();
        $log->libelle = "Impression de la liste des voitures enregistrées";
        $log->auteur = Auth::user()->id;
        $log->jour = date('Y-m-d');
        $log->save();

        ob_start();
        echo view('operations.printVoitures', compact('voitures'));
        $html = ob_get_contents();
        ob_end_clean();

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
    public function updateClient(Request $request,$id){
        if (empty($request->nom) || empty($request->grade) || empty($request->fonction) || empty($request->tel)){
            Flashy::error("tous les champs doivent etre renseignés");
            return redirect()->back();
        }
        $client = Client::where('numeroCNI',$id)->update([
            'nom' => $request->nom,
            'grade' => $request->grade,
            'fonction' => $request->fonction,
            'tel' =>$request->tel
        ]);
        Flashy::success("modification realisée avec success");
        return redirect()->back();
    }
}
