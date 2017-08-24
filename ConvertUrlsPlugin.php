<?php

namespace Craft;

class ConvertUrlsPlugin extends BasePlugin
{
    public function getName()
    {
        return Craft::t('Convert URLs');
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
        Craft::import('plugins.convertUrls.twigextensions.ConvertUrlsTwigExtension');
        return new ConvertUrlsTwigExtension();
    }
}
