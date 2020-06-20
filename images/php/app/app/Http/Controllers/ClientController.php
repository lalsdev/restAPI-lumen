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
        $firstName = $request->get('firstName');
        $lastName = $request->get('lastName');
        $street = $request->get('street');
        $city = $request->get('city');
        $zip = $request->get('zip');
        $number = $request->get('number');

        if (intval($zip) && intval($number) && ctype_alpha($firstName) && ctype_alpha($city) && ctype_alpha($street) && ctype_alpha($lastName)){
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
               } else {
                   return response('Zip and number must be numbers and all others inputs must be strings', 400);
        }
    }

    public function updateClient($client_id, Request $request){
        try{
            $client = Client::findOrFail($client_id);
        } catch(ModelNotFoundException $e){
            return response('Client not found', 404);

        }
        // essayé de faire une fonction pour vérifier types des variables firstname etc... ailleurs en l'ajoutant dans un dossier helpers et en faisant composer dump-autoload et en changeant le composer.json
        $client->update($request->all());
        return response()->json($client, 200);

    }
    public function deleteClient($client_id){
        try{
            Client::findOrFail($client_id)->delete();
        } catch(ModelNotFoundException $e){
            return response('Client not found', 404);
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
            return response('Contract not found', 404);
        }
        return response()->json($contrat, 200);
    }

    public function showOneContratSpecificClient($client_id, $contrat_id){
        try{
            $client = Client::findOrFail($client_id);
            $contrat = Contrat::findOrFail($contrat_id);
        } catch(ModelNotFoundException $e){
            if (empty($client)){
                return response('Client does not exist', 404);
            } else if (empty($contrat)){
                return response('Contract does not exist', 404);
            }
        }
        $contrat = $client->contrats
                       ->where('id', '=', $contrat_id)
                       ->first();  
        if (empty($contrat)){
            return response('This contract not linked to this client', 400);
        }      
        return response()->json($contrat, 200);
    }

    public function createContrat($client_id, Request $request){
        $energy= $request->get('energy'); 
        $product= $request->get('product'); 
        $duration= $request->get('duration'); 
        $codePromo= $request->get('codePromo'); 
        $gsm= $request->get('gsm');        
       
        try{
            $client = Client::findOrFail($client_id);
        } catch(ModelNotFoundException $e){
            return response('Client not found', 404);
        }
        $this->validate($request, [
            'energy' => 'required',
            'product' => 'required',
            'gsm' => 'required',
            'duration' => 'required',
            'codePromo' => 'required'
        ]);
        if (intval($duration) && intval($gsm) && ctype_alpha($energy) && ctype_alpha($product) && ctype_alpha($codePromo)){
            $contrat = Contrat::create([
                'energy' => $request->energy,
                'product' => $request->product,
                'gsm' => $request->gsm,
                'duration' => $request->duration,
                'codePromo' => $request->codePromo,
                'client_id' => $client->id
                 ]);
            return response()->json($contrat, 201);
        } else {
            return response('Gsm and duration must be numbers and all others inputs must be strings', 400);
        }
    }

    public function updateContrat($client_id,$contrat_id, Request $request){
        try{
            $client = Client::findOrFail($client_id);
            $contrat = Contrat::findOrFail($contrat_id);
        } catch(ModelNotFoundException $e){
            if (empty($client)){
                return response('Client not found', 404);
            } else if (empty($contrat)){
                return response('Contract not found', 404);
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
            return response('Client not found', 404);
        }
        $contrat = $client->contrats
                          ->where('id', '=', $contrat_id)
                          ->first()
                          ->delete();
        return response('Contract deleted successfully', 200);
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