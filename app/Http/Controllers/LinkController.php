<?php

namespace App\Http\Controllers;

use App\Http\Requests\UrlSubmissionRequest;
use App\Jobs\ProcessDomains;
use App\Jobs\ProcessUrl;
use App\Repositories\DomainRepository;
use App\Repositories\UrlRepository;
use App\Services\LinkService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    use ResponseTrait;

    public function __construct(
        private DomainRepository $domainRepository, 
        private UrlRepository $urlRepository,
        private LinkService $linkService
    ){}

    public function index(Request $request)
    {
        $links = $this->linkService->get($request->all());
        return response()->json(['links' => $links]);
    }

    public function count()
    {
        return response()->json($this->urlRepository->getCount());
    }

    public function search(Request $request)
    {
        $links = $this->linkService->search($request->all());
        return response()->json(['links' => $links]);
    }

    public function sort(Request $request)
    {
        $links = $this->linkService->sort($request->all());
        return response()->json(['links' => $links]);
    }

    public function create() 
    {
        return view('Link.create');
    }

    public function store(UrlSubmissionRequest $request)
    {
        $validatedData = $request->validated();
        $resultDomains = $this->storeMainDomains($validatedData);
        $resultUrls = $this->storeUrls($validatedData);
        if($resultDomains && $resultUrls)
        return response()->json(['message' => 'Job Successful']);
    }

    public function delete(Request $request)
    {
        $url = $this->urlRepository->getOneById($request->id);
        $url->delete();
    }

    private function storeMainDomains($data)
    {
        $domains = $data['main_domains'] ?? [];
        return ProcessDomains::dispatch($domains, $this->domainRepository);
    }

    private function storeUrls($data)
    {
        $urls = $data['urls'] ?? [];
        return ProcessUrl::dispatch($urls, $this->urlRepository, $this->domainRepository);
    }
}
