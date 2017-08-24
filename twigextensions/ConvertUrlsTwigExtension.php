<?php

namespace Craft;

use Exception;
use Twig_Extension;
use Twig_Filter_Method;

class ConvertUrlsTwigExtension extends Twig_Extension
{
    public function getName()
    {
        return 'Convert URLs';
    }

    public function getFilters()
    {
        return ['convertUrls' => new Twig_Filter_Method($this, 'convertUrls')];
    }

    public function convertUrls($html)
    {
        $html = $this->convertEntryUrls($html);
        $html = $this->convertAssetUrls($html);
        return $html;
    }

    private function convertEntryUrls($html)
    {
        preg_match_all('/{entry:([0-9]+):url}/', $html, $matches);

        $replacements = [];

        foreach ($matches[0] as $key => $assetString) {
            $replacements[$key] = $this->lookupEntryUrlById($matches[1][$key]);
        }

        $html = str_replace($matches[0], $replacements, $html);

        return $html;
    }

    private function lookupEntryUrlById($id)
    {
        $criteria = craft()->elements->getCriteria(ElementType::Entry);
        $criteria->id = $id;
        $entry = $criteria->first();

        if ($entry) {
            return str_replace('http://mattstauffer-co-old-craft.dev', '', $entry->getUrl());
        }

        throw new Exception("Cannot find entry for id {$id}");
    }

    private function convertAssetUrls($html)
    {
        preg_match_all('/{asset:([0-9]+):url}/', $html, $matches);

        $replacements = [];

        foreach ($matches[0] as $key => $assetString) {
            $replacements[$key] = $this->lookupAssetUrlById($matches[1][$key]);
        }

        $html = str_replace($matches[0], $replacements, $html);

        return $html;
    }

    private function lookupAssetUrlById($id)
    {
        $criteria = craft()->elements->getCriteria(ElementType::Asset);
        $criteria->id = $id;
        $asset = $criteria->first();

        if ($asset) {
            return $asset->getUrl();
        }

        throw new Exception("Cannot find asset for id {$id}");
    }
}
