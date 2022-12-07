<?php

namespace OutMart\Laravel\Customers\Manage;

use OutMart\Laravel\Customers\Models\Customer as ModelsCustomer;

class Customer
{
    private $customerModel;

    public function __construct()
    {
        $this->customerModel = config('outmart.customers.model', ModelsCustomer::class)::with(['customerable', 'addresses']);
    }

    public function query()
    {
        return (clone $this->customerModel);
    }

    public function find($id)
    {
        return (clone $this->customerModel)->find($id);
    }

    // public function listingCollection($customers)
    // {
    //     $collection = collect($customers);

    //     $customers = $collection->map(function ($customer) {
    //         return [
    //             'name' => $customer->customerable->name,
    //             'email' => $customer->customerable->email,
    //             'metadata' => $customer->metadata,
    //             'addresses' => $customer->addresses,
    //         ];
    //     });

    //     return $customers->all();
    // }

    // public function getCollection($method, ...$args)
    // {
    //     $data = $this->{$method}($args);

    //     return match ($method) {
    //         'listing' => $this->listingCollection($data),
    //     };
    // }
}