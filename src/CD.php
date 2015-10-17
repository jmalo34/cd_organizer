<?php
class CD
{
    private $title;

    function __construct($album_title)
    {
        $this->title = $album_title;
    }

    function setTitle($new_title)
    {
        $this->title = $new_title;
    }

    function getTitle()
    {
        return $this->title;
    }
}
 ?>
