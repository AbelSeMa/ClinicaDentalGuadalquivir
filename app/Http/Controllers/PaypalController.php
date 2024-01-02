<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Plan;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaypalController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('paypal');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function payment(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $planId = $request->input('idPlan');

        // Realiza una consulta para obtener el plan correspondiente
        $plan = Plan::find($planId);

        $precio = $plan->price;
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.payment.success'),
                "cancel_url" => route('paypal.payment/cancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "EUR",
                        "value" => $precio
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    $request->session()->put('idPlan', $planId);
                    return redirect()->away($links['href']);
                }
            }
            
            return redirect()
                ->route('cancel.payment')
                ->with('error', 'Something went wrong.');
        } else {
            
            return redirect()
                ->route('create.payment')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function paymentCancel()
    {
        return redirect()
            ->route('user.dashboard')
            ->with('error', $response['message'] ?? 'Has cancelado la transacción.');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function paymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $planId = intval($request->session()->get('idPlan'));
            $userId = auth()->user()->paciente->user_id;

            // Busca el paciente existente por user_id
            $patient = Patient::where('user_id', $userId)->first();

            
            if ($patient) {
                // Si el paciente existe, actualiza los campos relevantes
                try {
                    
                    $patient->plan_id = $planId;
                    $patient->payment_date = now();
                    $patient->expiration_date = now()->addYear();
                
                    $patient->save();
            
            
                } catch (\Exception $e) {
                    return redirect()->route('user.dashboard')->with('error', 'Error al actualizar el plan ' . $e->getMessage());
                }
            } else {
                // Maneja el caso en el que el paciente no existe (opcional)
                return redirect()->route('user.dashboard')->with('error', 'No ha sido posible actualizar los datos del paciente.');
            }



            return redirect()
                ->route('user.dashboard')
                ->with('success', 'Transacción completada. Su plan anual ahora está disponible');
        } else {
            return redirect()
                ->route('user.dashboard')
                ->with('error', $response['message'] ?? 'Algo ha salido mal. Por favor intentelo de nuevo.');
        }
    }
}
