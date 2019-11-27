<?php

namespace App\Http\Controllers;

use Model\Customer\CustomerRepository;

class ContractController extends Controller
{
    public function show($customer_id, CustomerRepository $customerRepository)
    {
        $customer = $customerRepository->get($customer_id);

        $current_date = now()->format('d/m/Y');

        return view('contract.show', compact('customer', 'current_date'));
    }
}
