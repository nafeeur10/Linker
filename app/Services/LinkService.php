<?php

namespace App\Services;

use App\Repositories\DomainRepository;
use App\Repositories\UrlRepository;
use App\Constants\Sort;

class LinkService
{
    private $take = 0;
    private $skip = 5;
    private $searchString = '';
    private $sortTerm = '';

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

    public function search($data)
    {
        $this->setSearchTerm($data);
        return $this->urlRepository->searchWith('path', $this->searchString, 'domain');
    }

    public function sort($data)
    {
        $this->setSortTerm($data);
        if($this->sortTerm == Sort::$LATEST)
        return $this->urlRepository->sortLatestWith('domain');
        else
        return $this->urlRepository->getAllWithRelationAndPaginaion('domain');
    }

    private function setLimitOffset($data)
    {
        $page = $data['page'];
        $skip = ($page - 1) * 5;
        $this->take = $data['take'] ?? 5;
        $this->skip = $skip ?? 0;
    }

    private function setSearchTerm($data)
    {
        $this->searchString = $data['query'];
    }

    private function setSortTerm($data)
    {
        $this->sortTerm = $data['option'];
    }
}