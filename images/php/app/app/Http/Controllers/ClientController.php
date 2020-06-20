<?php
namespace App\Http\Controllers;
use App\Client;
use App\Contrat;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class ClientController extends Controller {
    
    // CRUD Clients
    public function showAllClients(){
        return response()->json(Client::all());
    }
    public function showOneClient($client_id){
        try {
            $client = Client::findOrFail($client_id);
        } catch(ModelNotFoundException $e) {
            return response('Client not found', 404);
        }
            return response()->json($client, 200);
    }

    public function createClient(Request $request){
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'street' => 'required',
            'number' => 'required',
            'zip' => 'required',
            'city'=> 'required'
        ]);
        $client = Client::create($request->all());
        return response()->json($client, 201);
    }
    public function updateClient($client_id, Request $request){
        try{
            $client = Client::findOrFail($client_id);
        } catch(ModelNotFoundException $e){
            return response('Client not found', 404);

        }
        $client->update($request->all());
        return response()->json($client, 200);
    }
    public function deleteClient($client_id){
        try{
            Client::findOrFail($client_id)->delete();
        } catch(ModelNotFoundException $e){
            return response('Client not found');
        }
        return response('Deleted Successfully', 200);
    }

    // CRUD contrats
    public function showAllContrats(){
        $contrats = Contrat::all();        
        return response()->json($contrats, 200);
    }
    public function showOneContrat($contrat_id){
        try{
            $contrat = Contrat::findOrFail($contrat_id);
        } catch(ModelNotFoundException $e){
            return response('Contract not found');
        }
        return response()->json($contrat, 200);
    }
    public function showOneContratSpecificClient($client_id, $contrat_id){
        try{
            $client = Client::findOrFail($client_id);
            $contrat = Contrat::findOrFail($contrat_id);
        } catch(ModelNotFoundException $e){
            if (empty($client)){
                return response('Client not found');
            } else if (empty($contrat)){
                return response('Contract not found');
            }
        }
        $contrat = $client->contrats
                       ->where('id', '=', $contrat_id)
                       ->first();        
        return response()->json($contrat, 200);
    }
    public function createContrat($client_id, Request $request){
        try{
            $client = Client::findOrFail($client_id);
        } catch(ModelNotFoundException $e){
            return response('Client not found');
        }
        $this->validate($request, [
            'energy' => 'required',
            'product' => 'required',
            'gsm' => 'required',
            'duration' => 'required',
            'codePromo' => 'required'
        ]);
        $contrat = Contrat::create([
            'energy' => $request->energy,
            'product' => $request->product,
            'gsm' => $request->gsm,
            'duration' => $request->duration,
            'codePromo' => $request->codePromo,
            'client_id' => $client->id
             ]);
        return response()->json($contrat, 201);
    }

    public function updateContrat($client_id,$contrat_id, Request $request){
        try{
            $client = Client::findOrFail($client_id);
            $contrat = Contrat::findOrFail($contrat_id);
        } catch(ModelNotFoundException $e){
            if (empty($client)){
                return response('Client not found');
            } else if (empty($contrat)){
                return response('Contract not found');
            }
        }
        $contratClient = $client->contrats
                                ->where('id', '=', $contrat_id)
                                ->first()
                                ->update($request->all());
        $updatedContrat = $client->contrats
                                 ->where('id', '=', $contrat_id)
                                 ->first();
        return response()->json($updatedContrat, 200);
    }
    public function deleteContrat($client_id,$contrat_id, Request $request){
        try{
            $client = Client::findOrFail($client_id);
        } catch(ModelNotFoundException $e){
            return response('Client not found');
        }
        $contrat = $client->contrats
                          ->where('id', '=', $contrat_id)
                          ->first()
                          ->delete();
        return response()->json('Contract deleted successfully', 200);
    }
    public function showAllContratsFromClient($client_id){
        try {
            $client = Client::findOrFail($client_id);
        } catch(ModelNotFoundException $e) {
            return response('Client not found', 404);
        }
            $contrats = $client->contrats;
            return response()->json($contrats, 200);
    }

}