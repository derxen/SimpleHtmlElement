<?php

/**
 * Created by PhpStorm.
 * User: derxen
 * E-mail: dian.derksen@futureof.finance
 * Date: 29-4-2016
 * Time: 23:30
 */

/**
 * Class Element
 */
class SimpleHtmlElement
{
    public $nodes;
    public $tag;
    public $content;
    public $attributes;
    public $singles;

    /**
     * Define element properties
     * element constructor.
     * @param null $tag
     * @param array $attributes
     * @param null $content
     */
    function __construct($tag = null, $attributes = [], $content = null) {
        $this->tag          = $tag;
        $this->content      = $content;
        $this->attributes   = $attributes;
        $this->nodes        = [];

        $this->singles      = ['input', 'br', 'link', 'img', 'meta', 'area', 'base', 'col', 'command', 'embed', 'hr', 'param', 'source'];
    }

    /**
     * Catch function
     * @param $tag
     * @param $properties
     * @return SimpleHtmlElement as $node
     */
    public function __call($tag, $properties) {
        try {
            $attributes     = [];
            $content        = null;

            if (isset($properties[0]))
                $attributes = $properties[0];
            if (isset($properties[1]))
                $content    = $properties[1];

            $node           = new SimpleHtmlElement($tag, $attributes, $content);
            $this->nodes[]  = $node;

            return $node;
        } catch(Exception $ex) {
            die($ex->getMessage());
        }
    }

    /**
     * Set SimpleHtmlElement attribute(s)
     * @param array $attr
     */
    public function setAttribute($attr = []) {
        if (is_array($attr))
            $this->attributes   = array_merge($this->attributes, $attr);
        else
            $this->attributes[]     = $attr;
    }

    /**
     * Set content of SimpleHtmlElement
     * @param string $content
     * @param bool $override
     */
    public function setContent($content = '', $override = true) {
        if ($override)
            $this->content  = $content;
        else
            $this->content  .= $content;
    }

    /**
     * Return HTML of this SimpleHtmlElement
     * @return string
     */
    public function write() {
        $html                   = '';
        $attributes             = '';

        if ($this->tag) {
            if (is_array($this->attributes))
                foreach ($this->attributes as $a => $value)
                    $attributes .= ' ' . $a . '="' . $value . '"';

            $html               .= '<' . $this->tag . $attributes . '>';
            $html               .= $this->content;
        }

        if (count($this->nodes))
            foreach($this->nodes as $n)
                $html           .= $n->write();

        /**
         * Skip closing tags if no tag is present or if $this is a self-closing element
         */
        if ($this->tag && !in_array($this->tag, $this->singles))
            $html               .= '</' . $this->tag . '>';

        return $html;
    }

    /**
     * Call write() when echo is called on this SimpleHtmlElement
     * @return string
     */
    public function __toString() {
        return $this->write();
    }
}