<?php

namespace App\Services;

use App\Repositories\DomainRepository;

class LinkService
{
    private $take = 0;
    private $skip = 5;

    public function __construct(private DomainRepository $domainRepository)
    {
        
    }

    public function get($data)
    {
        $this->setLimitOffset($data);
        return $this->domainRepository->getAllWithRelationAndPaginaion('urls', $this->skip, $this->take);
    }

    private function setLimitOffset($data)
    {
        $this->take = $data['take'] ?? 5;
        $this->skip = $data['skip'] ?? 0;
    }
}