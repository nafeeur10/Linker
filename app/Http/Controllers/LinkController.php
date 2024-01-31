<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlSubmissionRequest;
use App\Jobs\ProcessDomains;
use App\Jobs\ProcessUrl;
use App\Repositories\DomainRepository;
use App\Repositories\UrlRepository;
use App\Traits\ResponseTrait;

class LinkController extends Controller
{
    use ResponseTrait;

    public function __construct(private DomainRepository $domainRepository, private UrlRepository $urlRepository)
    {
        
    }
    public function store(UrlSubmissionRequest $request)
    {
        $validatedData = $request->validated();
        //$resultDomains = $this->storeMainDomains($validatedData);
        $resultUrls = $this->storeUrls($validatedData);
        return 'Success';
    }

    private function storeMainDomains($data)
    {
        $domains = $data['main_domains'] ?? [];
        ProcessDomains::dispatch($domains, $this->domainRepository);
    }

    private function storeUrls($data)
    {
        $urls = $data['urls'] ?? [];
        ProcessUrl::dispatch($urls, $this->urlRepository, $this->domainRepository);
    }
}
