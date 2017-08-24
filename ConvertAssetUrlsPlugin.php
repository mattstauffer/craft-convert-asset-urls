<?php

namespace Craft;

class ConvertAssetUrlsPlugin extends BasePlugin
{
    public function getName()
    {
        return Craft::t('Convert Asset URLs');
    }

    public function getVersion()
    {
        return '1.0';
    }

    public function getDeveloper()
    {
        return 'Matt Stauffer';
    }

    public function getDeveloperUrl()
    {
        return 'http://www.mattstauffer.co/';
    }

    public function addTwigExtension()
    {
        Craft::import('plugins.convertAssetUrls.twigextensions.ConvertAssetUrlsTwigExtension');
        return new ConvertAssetUrlsTwigExtension();
    }
}
