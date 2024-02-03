<?php

namespace App\Repositories;

use App\Models\Domain;

class DomainRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(Domain::class);
    }

    public function create(array $data): Domain {
        $domain = $this->getFirstWhere('domain', $data['domain']);
        if(!$domain) return $this->model->create($data);
        else return $domain;
    }
}