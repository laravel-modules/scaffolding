<?php

namespace Modules\Accounts\Repositories;

use Modules\Contracts\CrudRepository;
use Modules\Accounts\Entities\Customer;
use Modules\Accounts\Http\Filters\CustomerFilter;

class CustomerRepository implements CrudRepository
{
    /**
     * @var \Modules\Accounts\Http\Filters\CustomerFilter
     */
    private $filter;

    /**
     * CustomerRepository constructor.
     *
     * @param \Modules\Accounts\Http\Filters\CustomerFilter $filter
     */
    public function __construct(CustomerFilter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * Get all clients as a collection.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all()
    {
        return Customer::filter($this->filter)->paginate();
    }

    /**
     * Save the created model to storage.
     *
     * @param array $data
     * @return \Modules\Accounts\Entities\Customer
     */
    public function create(array $data)
    {
        $customer = Customer::create($data);

        $this->setType($customer, $data);

        $customer->addAllMediaFromTokens();

        return $customer;
    }

    /**
     * Display the given client instance.
     *
     * @param mixed $model
     * @return \Modules\Accounts\Entities\Customer
     */
    public function find($model)
    {
        if ($model instanceof Customer) {
            return $model;
        }

        return Customer::findOrFail($model);
    }

    /**
     * Update the given client in the storage.
     *
     * @param mixed $model
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($model, array $data)
    {
        $customer = $this->find($model);

        $customer->update($data);

        $this->setType($customer, $data);

        $customer->addAllMediaFromTokens();

        return $customer;
    }

    /**
     * Delete the given client from storage.
     *
     * @param mixed $model
     * @throws \Exception
     * @return void
     */
    public function delete($model)
    {
        $this->find($model)->delete();
    }

    /**
     * Set the client type.
     *
     * @param \Modules\Accounts\Entities\Customer $customer
     * @param array $data
     * @return \Modules\Accounts\Entities\Customer
     */
    private function setType(Customer $customer, array $data)
    {
        if (isset($data['type'])) {
            $customer->setType($data['type']);
        }

        return $customer;
    }
}
