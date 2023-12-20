<?php

class Border {

    public function __construct(int $width, string $style, string $color )
    {
        $this->width = $width;
        $this->color = $color;
        $this->style = $style;
    }
    public int $width;
    public string $color;
    public string $style;
}

function split_border(string $css_border) : Border {
    
    // 1px solid #123456
    $parts = explode(' ', $css_border);
    return new Border((int)$parts[0],$parts[1],$parts[2]);

}
