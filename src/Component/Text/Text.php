<?php

namespace Component\Text;

class Text
{
    protected $content;

    protected $elements;

    protected $orderedElements;

    protected $separator;

    protected $parts;

    protected $occurrences;

    function __construct($content, $separator = null)
    {
        $this->content = $content;
        $this->separator = $separator;

        // Init properties
        $this->init();
    }

    protected function init()
    {
        $this->elements = array();

        $elements = str_split($this->content);

        foreach($elements as $element)
        {
            if(!isset($this->elements[$element])){
                $this->elements[$element] = 0;
            }

            $this->elements[$element]++;
        }

        // Order elements
        $orderedElements = $this->elements;

        arsort($orderedElements);

        $this->orderedElements = array_keys($orderedElements);

        // clean content
        $contentClean = $this->content;

        $contentClean = str_replace("\r\n", $this->separator, $contentClean);
        $contentClean = str_replace("\n", $this->separator, $contentClean);
        $contentClean = str_replace(". ", $this->separator, $contentClean);
        $contentClean = str_replace(", ", $this->separator, $contentClean);
        $contentClean = str_replace("'", $this->separator, $contentClean);
        $contentClean = strtolower($contentClean);

        // Parts
        if($this->separator) {

            $this->parts = array();

            $parts = explode($this->separator, $contentClean);

            foreach($parts as $part){
                if(trim($part) != ''){
                    $this->parts[] = $part;
                }
            }

            $this->occurrences = array();

            foreach($this->parts as $part) {
                if (!isset($this->occurrences[$part])){
                    $this->occurrences[$part] = 0;
                }

                $this->occurrences[$part]++;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;

        $this->init();
    }

    /**
     * @return mixed
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @param mixed $elements
     */
    public function setElements($elements)
    {
        $this->elements = $elements;
    }

    /**
     * @return mixed
     */
    public function getOrderedElements()
    {
        return $this->orderedElements;
    }

    /**
     * @return mixed
     */
    public function getSeparator()
    {
        return $this->separator;
    }

    /**
     * @param mixed $separator
     */
    public function setSeparator($separator)
    {
        $this->separator = $separator;

        $this->init();
    }

    /**
     * @return mixed
     */
    public function getParts()
    {
        return $this->parts;
    }

    /**
     * @return mixed
     */
    public function getOccurrences()
    {
        return $this->occurrences;
    }
}
