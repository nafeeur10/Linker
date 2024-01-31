<?php

namespace App\Repositories;

use App\Models\Url;

class UrlRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(Url::class);
    }

    public function create(array $data): Url {
        $url = $this->getFirstWhere('path', $data['path']);
        if(!$url) return $this->model->create($data);
        else return $url;
    }
}