# craft-convert-asset-urls

## What is this?

I was outputting a field in a way that didn't run it through Craft's `{asset:12345:url}` parser. I looked around for it for about an hour and then gave up so built this instead.

*This is not the right way to do this.* 

This is just here for fun.

## How to use this
Install the plugin and use the filter in Twig:

```twig
{{ entry.mdBody | convertAssetUrls }}
```
