<?php
namespace Jinas\Covid19;

use Jinas\Covid19\Adapters\IBaseAdapter;


class Statistics
{
        
    /**
     * LoadAdapter
     * 
     *  Handles Adapter loading
     *
     * @param  mixed  $adapter
     * @return object
     */
    public static function LoadAdapter(IBaseAdapter $adapter) : object
    {
        return $adapter;
    }
}
