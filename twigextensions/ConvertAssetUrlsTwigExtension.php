<?php

namespace Craft;

use Exception;
use Twig_Extension;
use Twig_Filter_Method;

class ConvertAssetUrlsTwigExtension extends Twig_Extension
{
    public function getName()
    {
        return 'Convert Asset URLs';
    }

    public function getFilters()
    {
        return ['convertAssetUrls' => new Twig_Filter_Method($this, 'convertAssetUrls')];
    }

    public function convertAssetUrls($html)
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
