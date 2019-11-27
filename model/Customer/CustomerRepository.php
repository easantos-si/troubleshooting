<?php
namespace Model\Customer;

class CustomerRepository
{
    protected $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function get($customer_id)
    {
        return $this->customer->with(['contract' => function ($query) use($customer_id) {
            $query->where('customer_id', $customer_id);
        },'contract.items'])->find($customer_id);
    }
}
