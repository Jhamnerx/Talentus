<?php

namespace App\Observers;

use App\Models\ChangesModels;
use App\Models\Payments;
use Illuminate\Support\Facades\Auth;

class PaymentsObserver
{

    public function retrieved(Payments $payment)
    {
        //dd($payment);
    }
    public function creating(Payments $payment)
    {
        $payment->empresas_id = session('empresa');
        $payment->user_id = Auth::user()->id;
    }

    public function created(Payments $payment)
    {
        ChangesModels::create([
            'change_id' => $payment->getKey(),
            'change_type' => Payments::class,
            'type' => 'create',
            'user_id' => Auth::user()->id,
        ]);
    }
    public function saving(Payments $payment)
    {
        //dd($payment);
    }

    public function updated(Payments $payment)
    {
        //
    }


    public function deleted(Payments $payment)
    {
        //
    }


    public function restored(Payments $payment)
    {
        //
    }


    public function forceDeleted(Payments $payment)
    {
        //
    }
}
