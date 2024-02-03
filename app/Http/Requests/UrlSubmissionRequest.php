<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UrlSubmissionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'urls' => 'required|array',
            'main_domains' => 'required|array'
        ];
    }

    public function all($keys = null): array
    {
        $data = parent::all($keys);
        $urlString = $data['links'];
        $urlArray = explode("\n", trim($urlString));
        $data['urls'] = $urlArray;
        $data['main_domains'] = $this->getMainDomains($urlArray);
        return $data;
    }

    public function authorize()
    {
        $this->all();
        return true;
    }

    private function getMainDomains($urls): array
    {
        $mainDomains = [];
        foreach ($urls as $url) {
            foreach ($urls as $url) {
                $mainDomains[] = getMainDomain($url);
            }
        }
        return array_unique($mainDomains);
    }
}
