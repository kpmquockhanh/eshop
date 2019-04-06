<?php
/**
 * Created by PhpStorm.
 * User: kpmquockhanh
 * Date: 2019-03-14
 * Time: 18:30
 */

namespace Khanhlq\Crawler;

use Openbuildings\Spiderling\Page;

class Step
{
    // Step contain:

    // name
    // type: list of links:1, detail_page:2, text:3, attribute:4
    // selector (xpath or css)

    const LIST_OF_LINKS = 1;
    const PAGE = 2;
    const DOM = 3;

    private $_page;
    private $type;
    private $selector;

    public function __construct($type, $selector)
    {
        $this->_page = new Page();
        $this->type = $type;
        $this->selector = $selector;
    }

    public function exec(String $baseUrl)
    {
        $this->_page->visit($baseUrl);
        switch ($this->type) {
            case self::LIST_OF_LINKS:

                $links = [];
                foreach($this->_page->all($this->selector) as $item) {
                    $links[] = $item->attribute('href');
                }
                return $links;

            case self::DOM:
                return $this->_page->find($this->selector);

            case self::PAGE:
                $url = $this->_page->find($this->selector)->attribute('href');
                return $this->_page->visit($url);

        }
        return null;
    }


}
