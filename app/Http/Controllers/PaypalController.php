<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Plan;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaypalController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function resumen($id)
    {
        $user = User::find(auth()->user()->id);
        $plan = Plan::find($id);

        return view('contratarPlan', compact('user', 'plan'));
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

        // Obtiene el plan actual del usuario
        $currentPlan = Auth::user()->paciente->plan;
    
        // Comprueba si el usuario ya tiene un plan contratado
        if ($currentPlan) {
            // Comprueba si el nuevo plan es superior al actual
            if ($plan->id > $currentPlan->id) {
                // Si es así, cobra sólo la diferencia de precio
                $precio = $plan->price - $currentPlan->price;
            } else {
                // Si no, devuelve un error
                return redirect('/planes')->with('error', 'El nuevo plan debe ser superior al actual');
            }
        } else {
            $precio = $plan->price;
        }

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
        if (auth()->user()->paciente) {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($request['token']);

            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                $planId = intval($request->session()->get('idPlan'));
                $userId = auth()->user()->paciente->user_id;
                $plan = Plan::findOrFail($planId);

                // Busca el paciente existente por user_id
                $patient = Patient::where('user_id', $userId)->first();


                if ($patient) {
                    try {

                        // Crear la factura
                        $transaction = new Transaction();
                        $transaction->user_id = $userId;
                        $transaction->plan_id = $planId;

                        if ($planId > Auth::user()->paciente->plan->id) {
                            $transaction->amount = $plan->price - Auth::user()->paciente->plan->price;
                        } else {
                            $transaction->amount = $plan->price;
                        }
                        
                        $transaction->date = now(); // Opcional: establece la fecha actual
                        $transaction->save();

                        $patient->plan_id = $planId;
                        $patient->payment_date = Carbon::now();
                        $patient->expiration_date = Carbon::now()->addYear();

                        $patient->save();


                    } catch (\Exception $e) {
                        return redirect()->route('user.dashboard')->with('error', 'Error al actualizar el plan ');
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
}
