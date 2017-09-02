<?php

/**
 * SeoSiteConfig
 * adds site-wide settings for SEO
 */
class SeoSiteConfig extends DataExtension
{
    private static $db = array(
        'GoogleWebmasterMetaTag' => 'Varchar(512)',
        'MetaTitleSeparator' => 'Varchar(8)',
        'MetaTitleHomeReversed' => 'Boolean',
    );

    /**
     * updateCMSFields.
     * Update Silverstripe CMS Fields for SEO Module
     *
     * @param FieldList
     */
    public function updateCMSFields(FieldList $fields)
    {
        if (Config::inst()->get('SeoObjectExtension', 'use_webmaster_tag')) {
            $fields->addFieldToTab(
                "Root.SEO",
                TextareaField::create(
                    "GoogleWebmasterMetaTag",
                    _t('SEO.SEOGoogleWebmasterMetaTag', 'Google webmaster meta tag')
                )->setRightTitle(_t(
                    'SEO.SEOGoogleWebmasterMetaTagRightTitle',
                    "Full Google webmaster meta tag For example &lt;meta name=\"google-site-verification\" content=\"hjhjhJHG12736JHGdfsdf\" /&gt;"
                ))
            );
            $fields->addFieldToTab(
                "Root.SEO",
                TextField::create(
                    "MetaTitleSeparator",
                    _t('SEO.MetaTitleSeparator', 'Meta title separator')
                )->setRightTitle(_t(
                    'SEO.MetaTitleSeparatorRightTitle',
                    "Sets the separator between title and site name in the meta title. Defaults to a pipe if empty."
                ))
            );
            $fields->addFieldToTab(
                "Root.SEO",
                CheckboxField::create(
                    "MetaTitleHomeReversed",
                    _t('SEO.MetaTitleHomeReversed', 'Reverse meta title for home')
                )->setRightTitle(_t(
                    'SEO.MetaTitleHomeReversedRightTitle',
                    "Sets the homepage to show the site name first followed by page title."
                ))
            );

        }
    }
}
