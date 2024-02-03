<?php

namespace App\Jobs;

use App\Repositories\DomainRepository;
use App\Repositories\UrlRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessUrl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private array $urls = [], private UrlRepository $urlRepository, private DomainRepository $domainRepository){}

    public function handle(): void
    {
        foreach ($this->urls as $url) {
            $urlData = $this->processUrlData($url);
            $this->urlRepository->create($urlData);
        }
    }

    private function processUrlData($url): array {
        $domain = getMainDomain($url);
        return [
            'domain_id' => $this->domainRepository->getFirstWhere('domain', $domain)['id'],
            'path'      => $url,
            'is_active' => 1
        ];
    }
}
