<?php

namespace App\Service;

use Symfony\Contracts\Cache\CacheInterface;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;

class MarkdownHelper {

    private MarkdownParserInterface $markdownParser;
    private CacheInterface $cache;
    private bool $isDebug;

    public function __construct(MarkdownParserInterface $markdownParser, CacheInterface $cache, bool $isDebug){
        $this->markdownParser = $markdownParser;
        $this->cache = $cache;
        $this->isDebug = $isDebug;
        dump($isDebug);
    }

    public function parse(string $source): string {

        if(!$this->isDebug){
            return $this->markdownParser->transformMarkdown($source);
        }

        return $this->cache->get('markdown_'.md5($source), function() use ($source) {
            return $this->markdownParser->transformMarkdown($source);
        });
    }
}