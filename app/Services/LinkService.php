<?php

namespace App\Services;

use App\Repositories\DomainRepository;
use App\Repositories\UrlRepository;

class LinkService
{
    private $take = 0;
    private $skip = 5;

    public function __construct(
        private DomainRepository $domainRepository,
        private UrlRepository $urlRepository
    )
    {
        
    }

    public function get($data)
    {
        $this->setLimitOffset($data);
        return $this->urlRepository->getAllWithRelationAndPaginaion('domain', $this->skip, $this->take);
    }

    private function setLimitOffset($data)
    {
        $page = $data['page'];
        $skip = ($page - 1) * 5;
        $this->take = $data['take'] ?? 5;
        $this->skip = $skip ?? 0;
    }
}