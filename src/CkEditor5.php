<?php

namespace Realevd\NovaCkeditor5;

use Laravel\Nova\Fields\Expandable;
use Laravel\Nova\Fields\Field;
use Mostafaznv\Larupload\Traits\Larupload;

class CkEditor5 extends Field
{
    use Expandable;

    public $showOnIndex = false;

    public $component = 'nova-ckeditor5';

    public string $language;

    public string $contentLanguage;

    public int $height = 400;

    public array $toolbar = [];
    public bool $shouldNotGroupWhenFull = false;
    public array $options = [];

    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $config = config('nova-ckeditor5');

        $this->language = $config['lang'];
        $this->contentLanguage = $config['content-lang'];
        $this->toolbar = $config['toolbar'];
        $this->shouldNotGroupWhenFull = $config['shouldNotGroupWhenFull'];
        $this->options = $config['options'];
        $this->height = $config['height'];
    }


    /**
     * Set the toolbar item layout
     *
     * @param array $toolbar
     * @return $this
     */
    public function toolbar(array $toolbar): self
    {
        $this->toolbar = $toolbar;

        return $this;
    }

    /**
     * Set the toolbar item layout
     *
     * @param bool shouldNotGroupWhenFull
     * @return $this
     */
    public function shouldNotGroupWhenFull(bool $shouldNotGroupWhenFull = true): self
    {
        $this->shouldNotGroupWhenFull = $shouldNotGroupWhenFull;

        return $this;
    }


    /**
     * Set other options for pass to CKEditor
     *
     * @param array $options
     * @return $this
     */
    public function options(array $options): self
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Set the editor height
     *
     * @param int $pixels
     * @return $this
     */
    public function height(int $pixels): self
    {
        $this->height = $pixels;

        return $this;
    }

    /**
     * Set Content Language
     *
     * @param string $lang
     * @return $this
     */
    public function contentLanguage(string $lang): self
    {
        $this->contentLanguage = $lang;

        return $this;
    }

    /**
     * Prepare the element for JSON serialization
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'height' => $this->height,
            'language' => $this->language,
            'contentLanguage' => $this->contentLanguage,
            'toolbar' => $this->toolbar,
            'shouldNotGroupWhenFull' => $this->shouldNotGroupWhenFull,
            'options' => $this->options,
            'shouldShow' => $this->shouldBeExpanded(),
        ]);
    }
}
