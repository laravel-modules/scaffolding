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
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @return \Modules\Accounts\Entities\Customer
     */
    public function create(array $data)
    {
        $customer = Customer::create($data);

        $this->setType($customer, $data);

        $this->uploadAvatar($customer, $data);

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
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($model, array $data)
    {
        $customer = $this->find($model);

        $customer->update($data);

        $this->setType($customer, $data);

        $this->uploadAvatar($customer, $data);

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

    /**
     * Upload the avatar image.
     *
     * @param \Modules\Accounts\Entities\Customer $customer
     * @param array $data
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig
     * @return \Modules\Accounts\Entities\Customer
     */
    private function uploadAvatar(Customer $customer, array $data)
    {
        if (isset($data['avatar'])) {
            $customer->addMedia($data['avatar'])->toMediaCollection('avatars');
        }

        return $customer;
    }
}
