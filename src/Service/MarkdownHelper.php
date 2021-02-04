<?php

namespace App\Service;

use Symfony\Contracts\Cache\CacheInterface;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkdownHelper {

    private $markdownParser;
    private $cache;

    public function __construct(MarkdownParserInterface $markdownParser, CacheInterface $cache){
        $this->markdownParser = $markdownParser;
        $this->cache = $cache;
    }

    public function parse(string $source): string {

        return $this->cache->get('markdown_'.md5($source), function() use ($source) {
            return $this->markdownParser->transformMarkdown($source);
        });
    }
}