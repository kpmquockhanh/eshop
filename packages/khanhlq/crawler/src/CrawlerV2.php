<?php
/**
 * Created by PhpStorm.
 * User: kpmquockhanh
 * Date: 2019-03-14
 * Time: 19:15
 */

namespace Khanhlq\Crawler;

use Openbuildings\Spiderling\Node;
use Openbuildings\Spiderling\Page;

class CrawlerV2
{

    /**
     * @var string $path
     */
    private $path;

//    private $crawler;


    public function __construct($path)
    {
        $this->path = $path;
//        $this->crawler = $page;
    }


    public function crawl()
    {
        $this->path = [
            'root' => 'https://hoayeuthuong.com/',
            'list_link' => '#top_menu li a',
            'fields' => [
                [
                    'type' => 'text',
                    'name' => 'title',
                    'selector' => '.r_item h1 span'
                ],
                [
                    'type' => 'text',
                    'name' => 'desc',
                    'selector' => '.r_item .desc'
                ]

            ],
        ];

        $rootPage = $this->getPage($this->path['root']);


        //Get list link
        $links = $this->getListLinkSimple($rootPage, $this->path['list_link']);
        foreach ($links as $link) {
            if ($link == $this->getBaseUrl()) {
                continue;
            }
            $currentPage = new Page();
            $currentPage->visit($link);

            // Get list detail page
            $detailLinks = $this->getListLinkSimple($currentPage, '.items .item .i a');

            $crawledDatas = [];
            foreach ($detailLinks as $detailLink) {
                $detailPage = (new Page())->visit($detailLink);

                $data = $this->getData($detailPage, $this->path['fields']);

                $crawledDatas[] = $data;
            }

            dd($crawledDatas);
        }

    }

    /**
     * Get all of list item to get detail page
     * @param Page $page
     * @param $selector
     * @return array
     */
    public function getListLinkSimple(Page $page, $selector)
    {
        $arrLinks = [];
        foreach ($page->all($selector) as $item) {
            $arrLinks[] = $this->getFullUrl($this->getAttribute($item, 'href'));
        }
        return $arrLinks;
    }

    /**
     * @param Page $page
     * @param string $selector
     * @param string $nextBtnSelector
     * @param string $attrNextButton
     * @return array
     */
    public function getListLinkPaginate(
        Page $page,
        string $selector,
        string $nextBtnSelector,
        string $attrNextButton = 'href'
    ) {
        $arrLinks = $this->getListLinkSimple($page, $selector);

        while ($nextLinkNode = $page->find($nextBtnSelector)) {
            $nextLink = $this->getAttribute($nextLinkNode, $attrNextButton);
            array_merge($arrLinks, $this->getListLinkSimple($page->visit($nextLink), $selector));
        }
        return $arrLinks;
    }

    /**
     * @param Node $node
     * @return string
     */
    public function getText(Node $node)
    {
        return $node->text();
    }

    /**
     * @param Node $node
     * @param string $attr
     * @return string
     */
    public function getAttribute(Node $node, string $attr)
    {
        return $node->attribute($attr);
    }

    /**
     * @param Node $node
     * @return string
     */
    public function getHtml(Node $node)
    {
        return $node->html();
    }

    /**
     * @param $url
     * @return Page
     */
    public function getPage($url)
    {
        $page = new Page();
        $page->visit($url);
        return $page;
    }

    /**
     * @param Page $page
     * @param array $field
     * @param bool $isMultiple
     * @param string $glue
     * @param string|null $attr
     * @return array
     */
    public function getValue(
        Page $page,
        array $field,
        bool $isMultiple = false,
        string $glue = " ",
        string $attr = null
    ) {
        $result = '';
        if ($isMultiple) {
            $elements = $page->all($field['selector']);
            $result = '';
            foreach ($elements as $index => $item) {
                $endGlue = ($index < count($elements) -1)?$glue:'';
                switch ($field['type']) {
                    case 'text':
                        $result .= $this->getText($item).$endGlue;
                        break;
                    case 'attribute':
                        $result .= $this->getAttribute($item, $attr).$endGlue;
                        break;
                    case 'html':
                        $result = $this->getHtml($item);
                        break;
                }
            }
        } else {
            $element = $page->find($field['selector']);
            switch ($field['type']) {
                case 'text':
                    $result = $this->getText($element);
                    break;
                case 'attribute':
                    $result = $this->getAttribute($element, $attr);
                    break;
                case 'html':
                    $result = $this->getHtml($element);
                    break;
            }
        }
        return [$field['name'] => $result];
    }

    public function getFullUrl($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_HOSTNAME)) {
            $parsedUrl = parse_url($this->path['root']);
            return $parsedUrl['scheme'].'://'.$parsedUrl['host'].'/'.$url;
        }
        return $url;
    }

    public function getBaseUrl()
    {
        $parsedUrl = parse_url($this->path['root']);

        return $parsedUrl['scheme'].'://'.$parsedUrl['host'].'//';
    }

    public function getData(Page $detailPage, array $fields)
    {
        $data = [];

        foreach ($fields as $field) {
            $val = $this->getValue($detailPage, $field);
            $data[] = $val;
        }

        return $data;
    }
}
