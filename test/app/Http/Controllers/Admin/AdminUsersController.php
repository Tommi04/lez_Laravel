<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // anche quando non abbiamo la classe Request come parametro il browser ci mette un gancio per prendere
        // le request. 
        // paginate fa questo qua sotto, una request, poi guarda se c'è una query e se non c'è ci ributta sulla prima pagina
        // dd ($request()->query());

        $queryString = request()->query();
        var_dump($queryString); //è una stringa, quindi in list.blade.php va testa con == e non ===
        // dd($queryString);

        //faccio il sort
        $params = [];

        //per capire in quale tab sono
        $current_tab = isset($queryString['tab']) ? $queryString['tab'] : 1;
        
        if(isset($queryString['sort'])){
            //without esclude i join
            // $users['active'] = User::without('details')->orderBy('name', $queryString['sort'])->paginate(5);
            $users['active'] = User::orderBy('name', $queryString['sort'])->paginate(5);
            $users['not_active'] = User::orderBy('name', $queryString['sort'])->onlyTrashed()->paginate(5);
            $params['sort'] = $queryString['sort'];
        }else{
            $users['active'] = User::paginate(5);
            $users['not_active'] = User::onlyTrashed()->paginate(5);
        }

        // $users = User::get();
        /*$users = [
            //paginate() è un query string, ci consente di fare una query con un contatore che ogni volta prende 
            //una lista limitante di users.
            //funziona come l'offset limit di vanilla php con un contatore già interno e un metodo di calcolo
            //PAGINATE() INCLUDE GET()

            //simplePaginate() mette solo i bottoni NEXT e PREV
            // 'active' => User::simplepaginate(5),

            //paginate() mette il numero delle pagine della lista
            'active' => User::paginate(5),

            // 'active' => User::get(),

            'not_active' => User::onlyTrashed()->paginate(5),
            // 'not_active' => User::onlyTrashed()->get(),

            //con paginate() possiamo usare il numero di pagine

        ];*/
        //cambia tutto tra get() e paginate(). get() ci mostra l'array, paginate() ci mostra un oggetto illuminator
        // dd($users);

        return view('admin.users.list', compact('users', 'current_tab'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //da costruire il giro
        $user = User::findOrFail($id);
        return view('admin.user.details', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {   App::setlocale('it');


        //il name del button in users/list.blade.php verrà passato alla request. delete_action
        // dd ($request->all());
        $action = $request->get('delete_action');

        //primo metodo
        // $deleted = User::where('id', $id)->delete();
        //torna il numero di righe

        //secondo metodo
        // $user = User::find($id);
        //torna true

        //contemplando anche gli eliminati, se non lo trovi fallisci
        $user = User::withTrashed()->findOrFail($id);

        //testiamo la policy
        $this->authorize('delete', $user);

        $deletion_result = '';
        if ($action === 'd'){
            //user -> nome relationship come funzione() -> delete()... 
            //cancella la relazione tra utente e dettaglio
            //ma non è una buona pratica poichè manca il legame tra le due operazioni
            // $user->details()->delete();
            //con il softDeleting forza l'eliminazione fisica del record
            // $deleted = $user->forceDelete();

            /*VEDIAMO LA STESSA COSA CON eloquent
            // se passo al callback una variabile la devo per forza estrarre prima. $user->id e non estrarlo nell' use()
            //usiamo la TRANSAZIONE per cancellare details e user
            $deleted = DB::transaction(function() use($id){ //se non ho l'id posso use ($user). NON POSSO FARE use($user->id)
                DB::table('user_details')
                    ->where(['user_id' => $id]) //uguale a quella sotto, se lo user_id = id
                    ->delete();

                    //booooooooooooh altre cose

                return DB::table('users')
                    ->where('id', $id) //uguale a quella sopra
                    ->delete();
            });
            // il risultato non ci torna sulla transaction ma su table ci torna il numero delle DELETE eseguite
            dd($deleted);
            */

            //USIAMO ELOQUENT
            // $deleted = DB::transaction(function() use($user){
            //     $user->details()->delete();
            //     return $user->forceDelete();
            // });
            
            //implemento il caso in cui va in errore con try catch. NON VA MESSO IL RETURN ALTRIMENTI ESCE DAL TRY
            try {
                DB::beginTransaction(); // tutto quello che è qua sotto farà parte della transazione e finirà con DB::commit()
                
                $user->details()->delete();
                throw new \Exception('sql error'); //per farlo andare in errore
                $user->forceDelete();

                DB::commit(); //finisce la transazione e facciamo la commit
                $deleted = true;

                //se non andrà a buon fine devo fare il rollback nel catch
            } catch (\Exception $th) {
                DB::rollBack(); //se non è andato a buon fine qualcosa devo fare il rollback qua
                // dd($th->getMessage());
                // dd($th->getCode());
                $deleted = false;
                $deletion_result = $th->getMessage();
            }
        }else{
            //usa il softDeleting, quindi valorizza la colonna "deleted_at" con il timestamp
            $deleted = $user->delete();
        }
        
        if ($deleted){
            session()->flash('message', __('labels.users.delete_success'));
            return redirect()->route('admin.adminusers.index');
        }else{
            session()->flash('message', __('labels.users.delete_error') . $deletion_result);
            return redirect()->route('admin.adminusers.index');
        }
        // dd($deleted);
    }

    public function restore($id){
        $user = User::withTrashed()->findOrFail($id);
        $restored = $user->restore();

        if($restored){
            session()->flash('succes', __('labels.users.restore_success'));
            return redirect()->route('admin.adminusers.index');
        }else{
            session()->flash('error', __('labels.users.restore_error'));
            return redirect()->route('admin.adminusers.index');
        }

        echo 'restore user: ' . $id;
    }
}
