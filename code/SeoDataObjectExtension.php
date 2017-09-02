<?php
/**
 * SeoDateObjectExtension extends a DataObject with functionality for helping content authors to
 * write good content for search engines.
 */
class SeoDataObjectExtension extends DataExtension {

    /**
     * Let the webmaster tag be edited by the CMS admin
     *
     * @config
     * @var boolean
     */
	private static $use_webmaster_tag = true;

	private static $db = array(
        'MetaTitle' => 'Varchar(255)',
        'MetaDescription' => 'Text',
        'ExtraMeta' => "HTMLText('meta, link')",
	);

	/**
	 * updateCMSFields.
 	 * Update Silverstripe CMS Fields for SEO Module
 	 *
	 * @param FieldList
	 * @return none
	 */
	public function updateCMSFields(FieldList $fields) {

        $config = SiteConfig::current_site_config();

		Requirements::css(SEO_DIR.'/css/seo.css');
		Requirements::javascript(SEO_DIR.'/javascript/seo-object.js');

		// lets create a new tab on top
		$fields->addFieldsToTab('Root.SEO', array(
			LiteralField::create('googlesearchsnippetintro', '<h3>' . _t('SEO.SEOGoogleSearchPreviewTitle', 'Preview google search') . '</h3>'),
			LiteralField::create('googlesearchsnippet', '<div id="google_search_snippet"></div>'),
			LiteralField::create('siteconfigtitle', '<div id="ss_siteconfig_title" class="hidden_literal_field">' . $config->Title . '</div>'),
            LiteralField::create('siteconfigseparator', '<div id="ss_metatitle_separator" class="hidden_literal_field">' . $config->MetaTitleSeparator . '</div>'),
            LiteralField::create('siteconfigreversed', '<div id="ss_metatitle_reversed" class="hidden_literal_field">' . $config->MetaTitleHomeReversed . '</div>'),
		));


		$fields->addFieldsToTab('Root.SEO', array(
            TextField::create("MetaTitle", "MetaTitle")
                ->setRightTitle(
                    _t(
                        'SiteTree.METATITLEHELP',
                        "Shown at the top of the browser window and used as the 'linked text' by search engines."
                    )
                )
                ->addExtraClass('help'),
			TextareaField::create("MetaDescription", "MetaDescription")
				->setRightTitle(
					_t(
						'SiteTree.METADESCHELP',
						"Search engines use this content for displaying search results (although it will not influence their ranking)."
					)
				)
				->addExtraClass('help'),
			TextareaField::create("ExtraMeta","Extra Meta")
				->setRightTitle(
					_t(
						'SiteTree.METAEXTRAHELP',
						"HTML tags for additional meta information. For example &lt;meta name=\"customName\" content=\"your custom content here\" /&gt;"
					)
				)
				->addExtraClass('help')
			)

		);

	}

}
