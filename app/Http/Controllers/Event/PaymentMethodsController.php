<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventInscription;
use App\Models\Boleto;
use App\Models\Event;
use App\Models\Pix;
use App\Models\CreditCard;

class PaymentMethodsController extends Controller
{
    public function storePaymentMethods(Request $request, $id)
    {

        // dd($request->all(), $id);

        $event = Event::findOrFail($id);

        $updateData = [];

        if ($request->input('boleto') === false) {
            Boleto::whereIn('event_inscription_id', $event->inscriptions->pluck('id'))->delete();
            $updateData['boleto_available_until'] = null;
            $updateData['boleto_discount'] = null;
        } else {
            $updateData['boleto_available_until'] = $request->input('boleto_available_until');
            $updateData['boleto_discount'] = $request->input('boleto_discount');
        }

        if ($request->input('pix') === false) {
            Pix::whereIn('event_inscription_id', $event->inscriptions->pluck('id'))->delete();
            $updateData['pix_available_until'] = null;
            $updateData['pix_discount'] = null;
        } else {
            $updateData['pix_available_until'] = $request->input('pix_available_until');
            $updateData['pix_discount'] = $request->input('pix_discount');
        }

        if ($request->input('credit_card') === false) {
            CreditCard::whereIn('event_inscription_id', $event->inscriptions->pluck('id'))->delete();
            $updateData['credit_card_allow_payment_in_up_to'] = null;
            $updateData['credit_card_installments_permitted_for_amounts_above'] = null;
            $updateData['credit_card_minimum_installment_value'] = null;
            $updateData['credit_card_available_until'] = null;
            $updateData['credit_card_discount'] = null;
        } else {
            $updateData['credit_card_allow_payment_in_up_to'] = $request->input('credit_card_allow_payment_in_up_to');
            $updateData['credit_card_installments_permitted_for_amounts_above'] = $request->input('credit_card_installments_permitted_for_amounts_above');
            $updateData['credit_card_minimum_installment_value'] = $request->input('credit_card_minimum_installment_value');
            $updateData['credit_card_available_until'] = $request->input('credit_card_available_until');
            $updateData['credit_card_discount'] = $request->input('credit_card_discount');
        }

        $event->update($updateData);

        $validatedData = $request->validate([
            'boleto' => 'required|boolean',
            'pix' => 'required|boolean',
            'credit_card' => 'required|boolean',
            'inscriptions.*.id' => 'required|exists:event_inscriptions,id',
            'inscriptions.*.selectedBoleto' => 'required|boolean',
            'inscriptions.*.selectedPix' => 'required|boolean',
            'inscriptions.*.selectedCreditCard' => 'required|boolean',
            'inscriptions.*.number_of_installments' => 'nullable|integer|min:1|max:12',
        ]);


        foreach ($validatedData['inscriptions'] as $inscriptionData) {
            $inscription = EventInscription::findOrFail($inscriptionData['id']);

            if ($inscriptionData['selectedBoleto']) {
                $boletoData = [
                    'event_inscription_id' => $inscription->id,
                    // 'available_until' => $request->input('boleto_available_until'),
                    // 'discount' => $request->input('boleto_discount'),
                ];
                Boleto::updateOrCreate(['event_inscription_id' => $inscription->id], $boletoData);
            } else {
                $inscription->boleto()->delete();
            }

            if ($inscriptionData['selectedPix']) {
                $pixData = [
                    'event_inscription_id' => $inscription->id,
                    // 'available_until' => $request->input('pix_available_until'),
                    // 'discount' => $request->input('pix_discount'),
                ];
                Pix::updateOrCreate(['event_inscription_id' => $inscription->id], $pixData);
            } else {
                $inscription->pix()->delete();
            }

            if ($inscriptionData['selectedCreditCard']) {
                $creditCardData = [
                    'event_inscription_id' => $inscription->id,
                    'number_of_installments' => $inscriptionData['number_of_installments'],
                ];
                CreditCard::updateOrCreate(['event_inscription_id' => $inscription->id], $creditCardData);
            } else {
                $inscription->creditCard()->delete();
            }
        }
    }
}
