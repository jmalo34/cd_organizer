<?php
class CD
{
    private $title;
    private $artist;

    function __construct($album_title, $album_artist)
    {
        $this->title = $album_title;
        $this->artist = $album_artist;
    }

    function setTitle($new_title)
    {
        $this->title = $new_title;
    }

    function getTitle()
    {
        return $this->title;
    }

    function setArtist($new_artist)
    {
        $this->artist = $new_artist;
    }

    function getArtist()
    {
        return $this->artist;
    }

    function save()
    {
        array_push($_SESSION['collection'], $this);
    }

    static function getAll()
    {
        return $_SESSION['collection'];
    }

    static function deleteAll()
    {
        $_SESSION['collection'] = array();
    }
}
 ?>
