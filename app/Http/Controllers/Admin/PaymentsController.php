<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PaymentsController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Payments $payments)
    {
        //
    }


    public function edit(Payments $payments)
    {
        //
    }


    public function update(Request $request, Payments $payments)
    {
        //
    }


    public function destroy(Payments $payments)
    {
        //
    }

    public function setNextSequenceNumber()
    {
        $id = IdGenerator::generate(['table' => 'payments', 'field' => 'numero', 'length' => 8, 'prefix' => 'PAY-']);
        return trim($id);
    }
}
