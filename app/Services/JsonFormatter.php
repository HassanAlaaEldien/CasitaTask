<?php

namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class JsonFormatter
{
    /**
     * @var string
     */
    private string $file_path;

    /**
     * @var string
     */
    private array $fileContent;

    /**
     * @param string $file_path
     */
    public function __construct(string $file_path)
    {
        $this->file_path = $file_path;
    }

    /**
     * @return array
     */
    public function getFileContent(): array
    {
        $this->readFile();
        return $this->fileContent;
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        $messages = $this->readFile()->concatenatedMessages();

        $locations = Http::get("https://maps.googleapis.com/maps/api/geocode/json?address={$messages}&key=" . env('GOOGLE_API_KEY'))
            ->json()['results'];

        return $this->mapLocationsData($locations);
    }

    /**
     * @return $this
     */
    private function readFile()
    {
        $fileContent = file_exists($this->file_path)
            ? json_decode(file_get_contents($this->file_path), TRUE)
            : [];
        $this->fileContent = call_user_func_array('array_merge', array_values($fileContent['Entries'] ?? []));

        return $this;
    }

    /**
     * @return string|null
     */
    private function concatenatedMessages()
    {
        $messages = null;
        Collection::make($this->fileContent)->each(function ($item) use (&$messages) {
            $messages .= " {$item['message']}";
        });

        return $messages;
    }

    /**
     * @param array $locations
     * @return array
     */
    private function mapLocationsData(array $locations): array
    {
        $messages = Collection::make($locations)->map(function ($location) {
            $item = collect($this->fileContent)
                ->filter(fn($item) => Str::contains($item['message'], $location['address_components'][0]['short_name']) || Str::contains($item['message'], substr($location['address_components'][0]['short_name'], 0, -3)))
                ->first();


            return [
                'name' => $location['address_components'][0]['short_name'],
                'location' => $location['geometry']['location'],
                'category' => $item['sentiment'],
                'message' => $item['message'],
                'pin_color' => match ($item['sentiment']) {
                    'Positive' => 'green',
                    'Negative' => 'red',
                    'Neutrual' => 'orange',
                    default => 'blue'
                }
            ];
        })->filter(fn($item) => request('type') ? $item['category'] === request('type') : true);

        return array_values($messages->toArray());
    }
}
