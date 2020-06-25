<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;

use App\Sponsorship;
use App\Apartment;
use App\Sponsorship_pack;
use App\ActiveSponsorship;

class SponsorshipController extends Controller
{

    public function store_sponsorship(Request $request)
    {

        $data = $request->all();

        // Storia delle sponsorizzazioni
        $new_sponsorship = new Sponsorship;
        $new_sponsorship->apartment_id = $data['apartId'];
        $new_sponsorship->sponsorship_pack_id = $data['radioVal'];
        $sponsorship_checked = Sponsorship_pack::findOrFail($data['radioVal']);
        $duration = $sponsorship_checked->duration;
        // $exp_date = Carbon::now()->addHour($duration)->format('Y-m-d-H-i-s');
        $exp_date = Carbon::now()->addHour($duration)->timestamp;
        $new_sponsorship->expiration_date = $exp_date;
        $new_sponsorship->save();

        // Sponsorizzazione attiva
        if(Apartment::find($request->input('apartId'))->activesponsorship()->exists()) { // se esiste
            $actual_exp_date = Apartment::find($request->input('apartId'))->activesponsorship->expiration_date; // timestamp like 

            // se il timestamp in expiration_date > now(), incremento il timestamp di
            // un numero di ore pari a $request->input('radioVal')
            if ($actual_exp_date > now()) {
                $actual_exp_date = $actual_exp_date->addHour($duration)->timestamp;
            } else {
                // sovrascrivo il timestamp con $exp_date
            }
        } else {
            // se non esiste la creo
            $new_active_sponsorship = new ActiveSponsorship;
            $new_active_sponsorship->apartment_id = $request->input('apartId');
            $exp_date = Carbon::now()->addHour($duration)->timestamp;
            $new_active_sponsorship->expiration_date = $exp_date;
            $new_active_sponsorship->save();
        }


        // DEVO AGGIUNGERE IL CONTROLLO:
        // se la sponsorizzazione è già attiva,
        // aggiornarla sommando al timestamp i giorni della nuova sponsorizzazione


        // attivo un evento di laravel per aggiornare la colonna updated_at
        // in questo modo Scout Extended che resta sempre in ascolto, capta l'evento
        // e aggiorna l'index di Algolia con il record 'exp_date'
        $apartment_to_touch = Apartment::find($request->input('apartId'));
        sleep(1); // addormento lo script per un secondo in modo che il save venga completato
        $apartment_to_touch->touch();

        return response('Success', 200)->header('Content-Type', 'text/plain');
        // $data = $request->input('id');

        // var_dump($request->all());
        // dd($request->all());


        // return view('user.apartments.show', 4);
        // return view('user.apartments.sponsorships');
    }
}
