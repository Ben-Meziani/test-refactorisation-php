<?php

class Template
{
    public $id;
    public $subject;
    public $content;

    public function __construct($id, $subject, $content)
    {
        $this->id = $id;
        $this->subject = $subject;
        $this->content = $content;
        var_dump($this->subject);
    }
}