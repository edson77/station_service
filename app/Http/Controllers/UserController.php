<?php

namespace App\Http\Controllers;


use App\Models\Log;
use App\Models\Notification;
use App\Models\Privilege;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use MercurySeries\Flashy\Flashy;


class UserController extends Controller
{
    public function  __construct(){
        $this->middleware('auth');
    }

    public function index(){
        if (Auth::user()->id_privileges == 3) {
            $users = User::where('is_deleted', 0)
                ->where('id_privileges', 2)
                ->get();
        }else{
            $users = User::where('is_deleted', 0)->get();
        }
        return view('users.index',[
            'users' => $users
        ]);
    }
    public function is_deleted(){
        $users = User::where('is_deleted',1)->get();

        return view('users.deleted',[
            'users' => $users
        ]);
    }

    public function create(){
        $privileges = Privilege::all();
        return view('users.create',[
            'privileges' => $privileges
        ]);
    }

    public function store(Request $request){
       /* $this->validate($request, [
            'nom' => 'required|min:2|max:255',
            'id_privileges' => 'required',
            'prenom' => 'required|min:2|max:255',
            'email' => 'required|string|min:5|max:255|unique:users',
            'identifiant' => 'required|string|min:5|max:255|unique:users',
            'password' => 'required|string|min:6',
            // 'password_confirmation' => 'required_with:password|same:password|min:6',

        ]);*/
        if (empty($request->nom) || empty($request->prenom) || empty($request->email) || empty($request->identifiant) || empty($request->password) || empty($request->phone)) {
            Flashy::error(" tous les champs doivent etre rempli");
            return redirect()->back();
        }

        $imageFileName ='';

        if ($request->hasFile('avatar')) {

            //uploader une image
            $file = $request->file('avatar');
            $files = $request->file('avatar')->getClientOriginalName();
            $imageFileName = time().'_'.$files;
            $path = public_path('/uploads/avatar');
            $file->move($path, $imageFileName);
        }
        $slug = Str::slug($request->nom.'&'.$request->prenom.'-'.time());
        $user = new User;
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->mail = $request->email;
        $user->phone = $request->phone;
        $user->avatar = $imageFileName;
        $user->identifiant = $request->identifiant;
        $user->password = bcrypt($request->password);
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        $user->id_privileges = $request->id_privileges;
        $user->datenaissance = $request->datenaissance;
        $user->is_deleted = 0;
        $user->slug = $slug;
        if ($user->save()){
            $data = array(
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'identifiant' => $request->identifiant,
                'password' => $request->password,
                'mail' => $request->email,
            );

            try {
                // Mail::to($data['email'])->send(new contactMail());
                Mail::send('users.mail', $data, function ($message) use ($data) {
                    $message->from('gedsed2019@gmail.com', 'GED SED');
                    $message->to($data['mail'])->subject('Vos identifiants de connexion');
                });

               /* Mail::send('users.mail', $data, function($message) use ($data) {
                    $message->to($data['mail'])->subject('Vos identifiants de connexion');
                });*/
            } catch (Exception $e) {

            }

            $touslesid =[];
            $idUsers =  DB::select("SELECT id FROM users WHERE (id_privileges = :p1 OR id_privileges = :p2 OR id_privileges = :p3) AND id != :id",[
                'p1' => 3,
                'p2' => 4,
                'p3' => 1,
                'id' => Auth::user()->id
            ]);
            foreach ($idUsers as $idUser){
                $touslesid[] = $idUser->id;
            }

            for ($i=0; $i< count($touslesid); $i++){
                $notification = new Notification();
                $notification->message = Auth::user()->nom." vient de creer l'utilisateur ".$request->nom." ".$request->prenom;
                $notification->send = Auth::user()->id;
                $notification->received = $touslesid[$i];
                $notification->unread = "0";
                $notification->created_at = Carbon::now();
                $notification->updated_at = Carbon::now();
                $notification->save();
            }
            Flashy::success("Utilisateur creer avec success");
            return redirect()->back();
        }
        Flashy::error("Une erreur c'est produite, l'utilisateur n'a été crée");
        return redirect()->back();


    }

    public function delete($id){
        if ($id != Auth::user()->id){
            User::find($id)->update(['is_deleted' => 1]);
            Flashy::success("l'utilisateur a été supprimé avec success");
            return redirect()->back();
        }
        Flashy::error("l'utilisateur authentifié ne peut pas etre supprimé");
        return redirect()->back();

    }
    public function restore($id){
        if ($id != Auth::user()->id){
            User::find($id)->update(['is_deleted' => 0]);
            Flashy::success("l'utilisateur a été restoré avec success");
            return redirect()->back();
        }
        return redirect()->back();

    }

    public function show(User $user){
        $ui = $user->id;
        $privileges = DB::select("SELECT p.privilege FROM users u, privileges p  WHERE u.id_privileges = p.id AND u.id = $ui");
        $privilege =$privileges[0]->privilege;
        return view('users.show',compact('user','privilege'));
    }
    public function showAuth(){
        $user = Auth::user();
        $ui = $user->id;
        $privileges = DB::select("SELECT p.privilege FROM users u, privileges p  WHERE u.id_privileges = p.id AND u.id = $ui");
        $privilege =$privileges[0]->privilege;
        return view('users.showauth',compact('user','privilege'));
    }

    public function update(User $user, Request $request){

        $user->nom =$request->nom;
        $user->prenom =$request->prenom;
        $user->mail =$request->email;
        $user->identifiant =$request->identifiant;

        if ($request->hasFile('avatar')) {

            //uploader une image
            $file = $request->file('avatar');
            $files = $request->file('avatar')->getClientOriginalName();
            $imageFileName = time().'_'.$files;
            $path = public_path('/uploads/avatar');
            $file->move($path, $imageFileName);
            $user->avatar =$imageFileName;
        }

        if ( !$request->password == '')
        {
            $user->password = bcrypt($request->password);
        }
        $user->updated_at = Carbon::now();

        if ($user->save()){
            Flashy::success("Utilisateur modifier avec success");
            return redirect()->back();
        }
        Flashy::error("Une erreur c'est produite, l'utilisateur n'a été modifier");
        return redirect()->back();
    }

    public function printUsers(){
        /*$users = User::orderBy('created_at', 'desc')->get();
        $html =  view('users.print', compact('users'));
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        die();
        //dd('pdf');
        //require_once __DIR__ . '/vendor/autoload.php';
        */
        if (Auth::user()->id_privileges == 3) {
            $users = User::where('is_deleted', 0)
                ->where('id_privileges', 2)
                ->get();
        }else{
            $users = User::where('is_deleted', 0)->get();
        }



        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'orientation' => 'landscape']);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->setHTMLFooter("
                                <div align='center' style='font-size: 13px'>
                                    <b>PETROLIUM</b> Plateforme de Gestion des stations services designed by <b>Edson Bitjoka </b>.<br>-- Ydé Cameroun -- Tel: (+237) 697878606 
                                </div>
                             ");

        $log = new Log();
        $log->libelle = 'Impression de la liste des utilisateurs';
        $log->auteur = Auth::user()->id;
        $log->jour = date('Y-m-d');
        $log->save();

        ob_start();
        echo view('users.print', compact('users'));
        $html = ob_get_contents();
        ob_end_clean();

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function printUsersId($id){
        $user = User::find($id);
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4', 'orientation' => 'landscape']);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->setHTMLFooter("
                                <div align='center' style='font-size: 13px'>
                                    <b>PETROLIUM</b> Plateforme de Gestion des stations services designed by <b>Edson Bitjoka </b>.<br>-- Ydé Cameroun -- Tel: (+237) 697878606 
                                </div>
                             ");

        $log = new Log();
        $log->libelle = "Impression d'un utilisateur";
        $log->auteur = Auth::user()->id;
        $log->jour = date('Y-m-d');
        $log->save();

        ob_start();
        echo view('users.printUser', compact('user'));
        $html = ob_get_contents();
        ob_end_clean();

        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
