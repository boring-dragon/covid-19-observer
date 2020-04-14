<?php
namespace Jinas\Covid19\MV\News\Drivers;

use Goutte\Client;
use Exception;

class Avas
{

    
    /**
     * ScrapNews
     *
     *  Fetch all the news about covid-19 in avas.
     *
     *  It'll return latest 5 artivles
     *
     * @return iterable
     */
    public static function ScrapNews() : iterable
    {
        try {
            $goutte = new Client();
            $baseURL = 'https://avas.mv/covid-19';
            $crawler = $goutte->request('GET', $baseURL);
            if ($goutte->getResponse()->getStatusCode() == 200) {
                $data = [];
            
                $crawler->filter('div[class*="block md:flex rtl md:-mx-4 mb-7"] h3')->each(function ($node) use (&$data) {
                    $data['title'][] = $node->text();
                });
         
                $crawler->filter('div[class*="block md:flex rtl md:-mx-4 mb-7"] a')->each(function ($node) use (&$data) {
                    $data['href'][] = $node->attr('href');
                });

                foreach ($data['title'] as $index => $title) {
                    $collection[] = collect([
                        "title" => $title,
                        "href" => "https://avas.mv". $data['href'][$index],
                        "logo" => "avas.png"
                        
                    ]);
                }
                return $collection;
            }
        } catch (Exception $e) {
            throw new \Exception("Error Loading avas news");
        }
    }
}
