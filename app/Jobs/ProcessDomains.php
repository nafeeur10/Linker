<?php

namespace App\Jobs;

use App\Repositories\DomainRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessDomains implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public function __construct(private array $domains = [], private DomainRepository $domainRepository){}

    public function handle(): void
    {
        foreach ($this->domains as $domain) {
            $domainData = $this->processDomainsData($domain);
            $this->domainRepository->create($domainData);
        }
    }

    private function processDomainsData($domain): array {
        return [
            'domain' => $domain
        ];
    }
}
