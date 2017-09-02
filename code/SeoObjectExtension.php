<?php
/**
 * SeoObjectExtension extends SiteTree with functionality for helping content authors to
 * write good content for search engines.
 */
class SeoObjectExtension extends SiteTreeExtension {

	/**
	 * Specify page types that will not include the SEO tab
	 *
	 * @config
	 * @var array
	 */
	private static $excluded_page_types = array(
		'ErrorPage',
		'RedirectorPage',
		'VirtualPage'
	);

    /**
     * Let the webmaster tag be edited by the CMS admin
     *
     * @config
     * @var boolean
     */
	private static $use_webmaster_tag = true;

	private static $db = array(
        'MetaTitle' => 'Varchar(255)',
	);

	/**
	 * updateCMSFields.
 	 * Update Silverstripe CMS Fields for SEO Module
 	 *
	 * @param FieldList
	 * @return none
	 */
	public function updateCMSFields(FieldList $fields) {

		// exclude SEO tab from some pages
		if (in_array($this->owner->getClassName(), Config::inst()->get("SeoObjectExtension", "excluded_page_types"))) {
			return;
		}

		Requirements::css(SEO_DIR.'/css/seo.css');
		Requirements::javascript(SEO_DIR.'/javascript/seo.js');

		// lets create a new tab on top
		$fields->addFieldsToTab('Root.SEO', array(
			LiteralField::create('googlesearchsnippetintro', '<h3>' . _t('SEO.SEOGoogleSearchPreviewTitle', 'Preview google search') . '</h3>'),
			LiteralField::create('googlesearchsnippet', '<div id="google_search_snippet"></div>'),
			LiteralField::create('siteconfigtitle', '<div id="ss_siteconfig_title" class="hidden_literal_field">' . $this->owner->getSiteConfig()->Title . '</div>'),
            LiteralField::create('siteconfigseparator', '<div id="ss_metatitle_separator" class="hidden_literal_field">' . $this->owner->getSiteConfig()->MetaTitleSeparator . '</div>'),
            LiteralField::create('siteconfigreversed', '<div id="ss_metatitle_reversed" class="hidden_literal_field">' . $this->owner->getSiteConfig()->MetaTitleHomeReversed . '</div>'),
		));

		// move Metadata field from Root.Main to SEO tab for visualising direct impact on search result

		$fields->removeFieldFromTab('Root.Main', 'Metadata');

		$fields->addFieldsToTab('Root.SEO', array(
            TextField::create("MetaTitle", $this->owner->fieldLabel('MetaTitle'))
                ->setRightTitle(
                    _t(
                        'SiteTree.METATITLEHELP',
                        "Shown at the top of the browser window and used as the 'linked text' by search engines."
                    )
                )
                ->addExtraClass('help'),
			TextareaField::create("MetaDescription", $this->owner->fieldLabel('MetaDescription'))
				->setRightTitle(
					_t(
						'SiteTree.METADESCHELP',
						"Search engines use this content for displaying search results (although it will not influence their ranking)."
					)
				)
				->addExtraClass('help'),
			TextareaField::create("ExtraMeta",$this->owner->fieldLabel('ExtraMeta'))
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
