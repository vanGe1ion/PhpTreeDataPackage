<?php
/**
 * Created by PhpStorm.
 * User: ea.kichaev
 * Date: 11.03.2020
 * Time: 16:14
 */

namespace TreeData\objects;


class Map
{
    private $root;
    private $trackArray = [];


    public function __construct($root, array $trackArray)
    {
        $this->root = $root;
        $this->trackArray = $trackArray;
    }

    //todo exceptions
    public function AddTrack($current, $val)
    {
        if (!$this->IsTrace($current)) {
            $this->trackArray[$current] = $val;
            return true;
        }
        return false;
    }

    public function AddTrackCascade(array $tracks)
    {
        foreach ($tracks as $current => $parent)
            $this->AddTrack($current, $parent);
    }

    public function ChangeTrack($current, $newVal)
    {
        if ($this->IsTrace($current)) {
            $this->trackArray[$current] = $newVal;
            return true;
        }
        return false;
    }

    public function RemoveTrack($current)
    {
        unset($this->trackArray[$current]);
    }

    public function RemoveTrackCascade($current)
    {
        $this->RemoveTrack($current);
        while ($next = array_search($current, $this->trackArray))
            $this->RemoveTrackCascade($next);
    }

    public function GetPath($current) : array
    {
        if (!$this->IsTrace($current))
            return null;

        $next = $current;
        $result = [$current];
        do{
            $next = $this->trackArray[$next];
            array_unshift($result, $next);
        }
        while ($next !== $this->root);
        return $result;
    }

    public function IsTrace($current) : bool
    {
        return array_key_exists($current, $this->trackArray);
    }

    public function IsTracked($current) : bool
    {
        return (array_search($current, $this->trackArray) ? true : false);
    }

}