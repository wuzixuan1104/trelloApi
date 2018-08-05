<?php
interface FlexContentBuilder {
  public function build($objs);
}

class FlexBubble implements FlexContentBuilder {
  public $flexAttrs = [];
  public function __construct(array $objs) {
    $this->flexAttrs['type'] = 'bubble';
    $this->build($objs);
  }
  public static function create(array $objs) {
    return new FlexBubble($objs);
  }
  public static function objsRecursiveToArray($objs) {
    return is_array($objs) ? array_map(function($obj) {
      return is_object($obj) ? array_map('self::objsRecursiveToArray', $obj->attrs()) : $obj;
    }, $objs) : $objs;
  }
  public function build($objs) {
    !$objs && gg('bubble 傳入參數需為陣列');
    $this->flexAttrs = array_merge($this->flexAttrs, self::objsRecursiveToArray($objs));
    return $this;
  }
  public function attrs() {
    return $this->flexAttrs;
  }
}

class FlexCarousel implements FlexContentBuilder {
  public $flexAttrs = [];
  public function __construct(array $bubbles) {
    $this->flexAttrs['type'] = 'carousel';
    $this->build($bubbles);
  }
  public static function create(array $bubbles) {
    return new FlexCarousel($bubbles);
  }
  public function build($bubbles) {
    !$bubbles && gg('Carousel 傳入Bubble參數需為陣列');
    foreach($bubbles as $bubble) {
      $this->flexAttrs['contents'][] = $bubble->flexAttrs;
    }
    return $this;
  }
  public function attrs() {
    return $this->flexAttrs;
  }
}

abstract class FlexComponents {
  protected $attrs = [];
  public function __construct() {}
  public function attrs() {
    return $this->attrs;
  }
}
class FlexBox extends FlexComponents{
  public function __construct(array $contents) {
    parent::__construct();
    $this->attrs['type'] = 'box';
    $this->setContents($contents);
  }
  public static function create( $contents ) {
    return new FlexBox($contents);
  }
  public function setLayout($value) {
    if(is_string($value)) $this->attrs['layout'] = $value;
    return $this;
  }
  public function setContents(array $contents) {
    $this->attrs['contents'] = $contents;
    return $this;
  }
  public function setSpacing($value) {
    if(is_string($value)) $this->attrs['spacing'] = $value;
    return $this;
  }
  public function setFlex($value) {
    if(is_numeric($value)) $this->attrs['flex'] = $value;
    return $this;
  }
  public function setMargin($value) {
    if(is_string($value)) $this->attrs['margin'] = $value;
    return $this;
  }
}
class FlexButton extends FlexComponents {
  public function __construct($style) {
    $this->attrs['type'] = 'button';
    $this->setStyle($style);
  }
  public static function create($style) {
    return new FlexButton($style);
  }
  public function setAction($action) {
    $this->attrs['action'] = $action;
    return $this;
  }
  public function setFlex($value) {
    if(is_string($value)) $this->attrs['flex'] = $value;
    return $this;
  }
  public function setMargin($value) {
    if(is_string($value)) $this->attrs['margin'] = $value;
    return $this;
  }
  public function setHeight($value) {
    if(is_string($value)) $this->attrs['height'] = $value;
    return $this;
  }
  public function setStyle($value) {
    if(is_string($value)) $this->attrs['style'] = $value;
    return $this;
  }
  public function setColor($value) {
    if(is_string($value)) $this->attrs['color'] = $value;
    return $this;
  }
  public function setGravity($value) {
    if(is_string($value)) $this->attrs['gravity'] = $value;
    return $this;
  }
}
class FlexIcon extends FlexComponents{
  public function __construct($url) {
    parent::__construct();
    $this->attrs['type'] = 'icon';
    $this->setUrl($url);
  }
  public static function create($url) {
    return new FlexIcon($url);
  }
  public function setUrl($value) {
    if(is_string($value)) $this->attrs['url'] = $value;
    return $this;
  }
  public function setMargin($value) {
    if(is_string($value)) $this->attrs['margin'] = $value;
    return $this;
  }
  public function setSize($value) {
    if(is_string($value)) $this->attrs['size'] = $value;
    return $this;
  }
  public function setAspectRatio($value) {
    if(is_string($value)) $this->attrs['aspectRatio'] = $value;
    return $this;
  }
}
class FlexImage extends FlexComponents{
  public function __construct($url) {
    $this->attrs['type'] = 'image';
    $this->setUrl($url);
  }
  public static function create($url) {
    return new FlexImage($url);
  }
  public function setUrl($value) {
    if(is_string($value)) $this->attrs['url'] = $value;
    return $this;
  }
  public function setFlex($value) {
    if(is_numeric($value)) $this->attrs['flex'] = $value;
    return $this;
  }
  public function setMargin($value) {
    if(is_string($value)) $this->attrs['margin'] = $value;
    return $this;
  }
  public function setAlign($value) {
    if(is_string($value)) $this->attrs['align'] = $value;
    return $this;
  }
  public function setGravity($value) {
    if(is_string($value)) $this->attrs['gravity'] = $value;
    return $this;
  }
  public function setSize($value) {
    if(is_string($value)) $this->attrs['size'] = $value;
    return $this;
  }
  public function setAspectRatio($value) {
    if(is_string($value)) $this->attrs['aspectRatio'] = $value;
    return $this;
  }
  public function setAspectMode($value) {
    if(is_string($value)) $this->attrs['aspectMode'] = $value;
    return $this;
  }
  public function setBackgroundColor($value) {
    if(is_string($value)) $this->attrs['backgroundColor'] = $value;
    return $this;
  }
  public function setAction() {

  }
}
class FlexSeparator extends FlexComponents{
  public function __construct() {
    parent::__construct();
    $this->attrs['type'] = 'separator';
  }
  public static function create() {
    return new FlexSeparator();
  }
  public function setMargin($value) {
    if(is_string($value)) $this->attrs['margin'] = $value;
    return $this;
  }
  public function setColor($value) {
    if(is_string($value)) $this->attrs['color'] = $value;
    return $this;
  }
}
class FlexSpacer extends FlexComponents{
  public function __construct($size) {
    parent::__construct();
    $this->attrs['type'] = 'spacer';
    $this->setSize($size);
  }
  public static function create($size) {
    return new FlexSpacer($size);
  }
  public function setSize($value) {
    if(is_string($value)) $this->attrs['size'] = $value;
    return $this;
  }
}
class FlexText extends FlexComponents {
  public function __construct($text) {
    parent::__construct();
    $this->attrs['type'] = 'text';
    $this->setText($text);
  }
  public static function create($text) {
    return new FlexText($text);
  }
  public function setText($value) {
    if(is_string($value)) $this->attrs['text'] = $value;
    return $this;
  }
  public function setFlex($value) {
    if(is_numeric($value)) $this->attrs['flex'] = $value;
    return $this;
  }
  public function setMargin($value) {
    if(is_string($value)) $this->attrs['margin'] = $value;
    return $this;
  }
  public function setSize($value) {
    if(is_string($value)) $this->attrs['size'] = $value;
    return $this;
  }
  public function setAlign($value) {
    if(is_string($value)) $this->attrs['align'] = $value;
    return $this;
  }
  public function setGravity($value) {
    if(is_string($value)) $this->attrs['gravity'] = $value;
    return $this;
  }
  public function setWrap($value) {
    if(is_string($value)) $this->attrs['wrap'] = $value;
    return $this;
  }
  public function setWeight($value) {
    if(is_string($value)) $this->attrs['weight'] = $value;
    return $this;
  }
  public function setColor($value) {
    if(is_string($value)) $this->attrs['color'] = $value;
    return $this;
  }
  public function setAction($value) {
    $this->attrs['action'] = $value;
    return $this;
  }

}