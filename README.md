# Silverstripe SEO Module

## Maintainer Contact

* Jeff Whitfield (Nickname: jeffwhitfield)
* [Soulcraft Group](https://www.soulcraftgroup.com)

Forked from the Silverstripe SEO Module maintained by:

* Bart van Irsel (Nickname: hubertusanton)
* [Webium](http://www.webium.nl)



## Requirements

* SilverStripe 3.*

## Documentation

This module helps the administrator of the Silverstripe website in getting good results in search engines.

The fields for meta data in pages will be moved to a SEO part by this module.
This is done for giving a realtime preview on the google search result of the page.

In seo.yml config file you can specify which classes will NOT use the module.
By default every class extending Page will use the SEO module.
Caution: The new master branch is not compatible with old releases see [this pull request](https://github.com/hubertusanton/silverstripe-seo/pull/10) from [jonom](https://github.com/jonom) (thanks!).
Please use tag 1.1 in old sites with the old config and tag 2.0 for new projects, but updating to 2.0 will also fix google suggest and
has some other fixes.

## Installation
Place the module dir in your website root and run /dev/build?flush=all
