<?php
namespace Jinas\Covid19;

use Intervention\Image\ImageManagerStatic as Image;
use Jinas\Covid19\GlobalStats;

class Render
{
    //Configs For output
    protected const FONT = '..'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'fonts'.DIRECTORY_SEPARATOR.'Aleo-Bold.ttf';
    protected const FONT_SIZE = 35;
    protected const TEXT_ALIGN = "center";
    protected const TEXT_COLOR = "#fdf6e3";



    
    /**
     * RenderGlobal
     * 
     *  Render the world stats as an image
     *z
     * @return void
     */
    public static function RenderGlobal() : void
    {
        //Getting the world image template to render
        $img = Image::make('..'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'world.jpg');
        $stats = new GlobalStats;
        $cases = $stats->GetTotal();


        $active = $cases["total_confirmed"] - $cases["total_recovered"] - $cases["total_deaths"];

    
        // Recovered render
        $img->text($cases["total_recovered"], 270, 80, function ($font) {
            $font->file(self::FONT);
            $font->size(self::FONT_SIZE);
            $font->color(self::TEXT_COLOR);
            $font->align(self::TEXT_ALIGN);
            $font->valign('top');
            $font->angle(0);
        });

        //deaths
        $img->text($cases["total_deaths"], 270, 200, function ($font) {
            $font->file(self::FONT);
            $font->size(self::FONT_SIZE);
            $font->color(self::TEXT_COLOR);
            $font->align(self::TEXT_ALIGN);
            $font->valign('top');
            $font->angle(0);
        });

        //confirmed
        $img->text($cases["total_confirmed"], 750, 80, function ($font) {
            $font->file(self::FONT);
            $font->size(self::FONT_SIZE);
            $font->color(self::TEXT_COLOR);
            $font->align(self::TEXT_ALIGN);
            $font->valign('top');
            $font->angle(0);
        });

        //active
        $img->text($active, 750, 200, function ($font) {
            $font->file(self::FONT);
            $font->size(self::FONT_SIZE);
            $font->color(self::TEXT_COLOR);
            $font->align(self::TEXT_ALIGN);
            $font->valign('top');
            $font->angle(0);
        });
        //$img->save('public/worldstats.jpg');

        echo $img->response();
       
    }

    //Adding
    public function RenderMaldives() : void
    {
        
    }
}
