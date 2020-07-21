<?php

namespace Jinas\Covid19;

use Intervention\Image\ImageManagerStatic as Image;

class Render
{
    //Configs For output
    protected const FONT = '..'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'fonts'.DIRECTORY_SEPARATOR.'Aleo-Bold.ttf';
    protected const FONT_SIZE = 180;
    protected const TEXT_ALIGN = 'center';

    /**
     * RenderGlobal.
     *
     *  Render the world stats as an image
     *z
     *
     * @return void
     */
    public static function RenderGlobal(): void
    {
        //Getting the world image template to render
        $img = Image::make('..'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'world.png');
        $stats = Statistics::LoadAdapter(new \Jinas\Covid19\Adapters\Covid19API());
        $cases = $stats->GetTotal();

        $active = $cases['total_confirmed'] - $cases['total_recovered'] - $cases['total_deaths'];

        // Recovered render
        $img->text(number_format($cases['total_recovered']), 1250, 800, function ($font) {
            $font->file(self::FONT);
            $font->size(self::FONT_SIZE);
            $font->color('#1BC98E');
            $font->align(self::TEXT_ALIGN);
            $font->valign('top');
            $font->angle(0);
        });

        //deaths
        $img->text(number_format($cases['total_deaths']), 1250, 1500, function ($font) {
            $font->file(self::FONT);
            $font->size(self::FONT_SIZE);
            $font->color('#E64759');
            $font->align(self::TEXT_ALIGN);
            $font->valign('top');
            $font->angle(0);
        });

        //confirmed
        $img->text(number_format($cases['total_confirmed']), 3385, 800, function ($font) {
            $font->file(self::FONT);
            $font->size(self::FONT_SIZE);
            $font->color('#FF5D26');
            $font->align(self::TEXT_ALIGN);
            $font->valign('top');
            $font->angle(0);
        });

        //active
        $img->text(number_format($active), 3385, 1500, function ($font) {
            $font->file(self::FONT);
            $font->size(self::FONT_SIZE);
            $font->color('#FFB100');
            $font->align(self::TEXT_ALIGN);
            $font->valign('top');
            $font->angle(0);
        });
        //$img->save('public/worldstats.jpg');

        echo $img->response();
    }
}
