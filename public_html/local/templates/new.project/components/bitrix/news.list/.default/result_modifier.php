<?php
/**
 * @var CBitrixComponentTemplate $this
 * @var CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

// @TODO: replace to parameters
$arParams['PICTURE_URL'] = 'DETAIL_PAGE'; // || "" || DETAIL_PICTURE;

// define iblock code
$res = CIBlock::GetByID($arParams['IBLOCK_ID']);
if ($ar_res = $res->GetNext()) $arParams['IBLOCK_CODE'] = $ar_res['CODE'];

// define empty variables
if (empty($arParams['COLUMNS'])) $arParams['COLUMNS'] = 1;
$arResult['VAR']['ROW_CLASS'] = !empty($arParams['ROW_CLASS']) ? $arParams['ROW_CLASS'] : 'row';
if (empty($arParams['ITEM_CLASS'])) $arParams['ITEM_CLASS'] = 'item';
if (empty($arParams["NAME_TAG"])) $arParams["NAME_TAG"] = 'h3';

// define list class
$arSectionClass = array('news-list');
if ( ! empty($arParams['ITEM_CLASS']))  $arSectionClass[] = $arParams['ITEM_CLASS'] . "-list";
if ( ! empty($arParams['IBLOCK_CODE'])) $arSectionClass[] = "news-list_type_" . $arParams['IBLOCK_CODE'];
if ( ! empty($arParams['IBLOCK_ID']))   $arSectionClass[] = "news-list_id_" . $arParams['IBLOCK_ID'];

$arResult['VAR']['SECTION_CLASS'] = implode(' ', $arSectionClass);

/**
 * Transfer to epilogue
 *
 * @var CBitrixComponent $cp
 */
if ($cp = $this->getComponent()) {
    $cp->arResult['SECTION_CLASS'] = $arResult['SECTION_CLASS'];
    $cp->arParams['ROW_CLASS'] = $arParams['ROW_CLASS'];

    $cp->SetResultCacheKeys(array('SECTION_CLASS'));
}

if (!class_exists('CBitrixNewsItemTemplate')):
    class CBitrixNewsItemTemplate
    {
        public $arParams;
        public $arItem;

        public function __construct($arParams, $arItem)
        {
            $this->arParams = $arParams;
            $this->arItem = $arItem;
        }

        public function getPicture()
        {
            $strPict = '';
            $strPictURL = isset($this->arParams['PICTURE_URL']) && "DETAIL_PICTURE" === $this->arParams['PICTURE_URL'] ?
                htmlspecialcharsEx($this->arItem["DETAIL_PICTURE"]["SRC"]) : $this->arItem['DETAIL_PAGE_URL'];

            if (!empty($this->arItem["PREVIEW_PICTURE"]["SRC"])) {
                // create img element
                $strPict = sprintf('<img src="%s" alt="%s">',
                    htmlspecialcharsEx($this->arItem["PREVIEW_PICTURE"]["SRC"]),
                    htmlspecialcharsEx($this->arItem["NAME"])
                );

                if (strlen($strPictURL) > 2) {
                    // wrap to link
                    $strPict = sprintf('<a href="%s"%s>%s</a>',
                        $strPictURL,
                        "DETAIL_PICTURE" !== $this->arParams['PICTURE_URL'] ? $this->arItem['LINK_ATTRS'] : '',
                        $strPict
                    );
                }
            }

            // wrap to module box
            return sprintf('<div class="%s">%s</div>',
                htmlspecialcharsEx($this->arParams['ITEM_CLASS']) . '__pict',
                $strPict
            );
        }

        public function getName()
        {
            $strNameClass = $this->arParams['ITEM_CLASS'] . '__name';

            if (strlen($this->arItem['DETAIL_PAGE_URL']) > 2) {
                // wrap to module with link
                return sprintf('<a href="%4$s" class="%3$s d-block"%5$s><%1$s>%2$s</%1$s></a>',
                    htmlspecialcharsEx($this->arParams["NAME_TAG"]),
                    $this->arItem["NAME"], // strip_tags?
                    htmlspecialcharsEx($strNameClass),
                    $this->arItem['DETAIL_PAGE_URL'],
                    $this->arItem['LINK_ATTRS']
                );
            } else {
                // wrap to module box
                return sprintf('<%1$s class="%3$s">%2$s</%1$s>',
                    htmlspecialcharsEx($this->arParams["NAME_TAG"]),
                    $this->arItem["NAME"], // strip_tags?
                    htmlspecialcharsEx($this->arParams['ITEM_CLASS'] . '__name')
                );
            }
        }

        public function getDate()
        {
            $date = $this->arItem["DISPLAY_ACTIVE_FROM"] ? strip_tags($this->arItem["DISPLAY_ACTIVE_FROM"]) : '';

            // wrap to module box
            return sprintf('<div class="%s__date">%s</div>',
                htmlspecialcharsEx($this->arParams['ITEM_CLASS']),
                $date
            );
        }

        function getDescription()
        {
            $text = $this->arItem["PREVIEW_TEXT"] ? $this->arItem["PREVIEW_TEXT"] : '';

            // wrap to module box
            return sprintf('<div class="%s__desc">%s</div>',
                htmlspecialcharsEx($this->arParams['ITEM_CLASS']),
                $text
            );
        }

        public function getMoreLink()
        {
            $this->arItem['MORE_LINK_TEXT'] = $this->arParams["MORE_LINK_TEXT"];

            if (empty($this->arItem["MORE_LINK_TEXT"])) return '';
            if ("Y" === $this->arParams["HIDE_LINK_WHEN_NO_DETAIL"] || empty($this->arItem["DETAIL_TEXT"])) return '';

            if (strlen($this->arItem['DETAIL_PAGE_URL']) > 2) {
                return sprintf('<div class="%1$s__more"><a class="btn" href="%2$s"%3$s>%4$s</a></div>',
                    htmlspecialcharsEx($this->arParams['ITEM_CLASS']),
                    $this->arItem['DETAIL_PAGE_URL'],
                    $this->arItem['LINK_ATTRS'],
                    $this->arItem["MORE_LINK_TEXT"]
                );
            }

            return '';
        }

        function getSectionName()
        {
            if (empty($this->arItem['IBLOCK_SECTION_ID'])) return '';

            // Get section name by id
            $arSection = \Bitrix\Iblock\SectionTable::getList(array(
                'select' => array('ID', 'NAME'),
                'filter' => array('=ID' => $this->arItem['IBLOCK_SECTION_ID']),
            ))->fetch();

            $strSectName = $arSection['NAME'] ? strip_tags($arSection['NAME']) : '';

            return sprintf('<div class="%s__sect">%s</div>',
                htmlspecialcharsEx($this->arParams['ITEM_CLASS']),
                $strSectName
            );
        }

        function getProperties()
        {
            $properties = [];
            foreach ($this->arItem['DISPLAY_PROPERTIES'] as $propCode => $arProperty) {
                if (is_array($arProperty['VALUE'])) {
                    $arProperty['VALUE'] = implode(', ', $arProperty['VALUE']);
                }

                $properties[] = sprintf('<div class="%1$s__prop %1$s-prop %1$s-prop__%2$s">%3$s</div>',
                    htmlspecialcharsEx($this->arParams['ITEM_CLASS']),
                    htmlspecialcharsEx(strtolower($propCode)),
                    $arProperty['VALUE']
                );
            }

            return $properties;
        }
    }
endif;

foreach ($arResult["ITEMS"] as &$arItem) {
    // add edit areas
    $this->AddEditAction(
        $arItem['ID'],
        $arItem['EDIT_LINK'],
        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")
    );

    $this->AddDeleteAction(
        $arItem['ID'],
        $arItem['DELETE_LINK'],
        CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array(
            "CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')
        )
    );

    $arItem['LINK_ATTRS'] = '';

    /** @var string Y | N */
    $arItem["USER_HAVE_ACCESS"] = $arResult["USER_HAVE_ACCESS"];
    // disable access if link is empty
    if (strlen($arItem["DETAIL_PAGE_URL"]) <= 1) {
        $arItem["USER_HAVE_ACCESS"] = false;
    }

    $arItem['DETAIL_PAGE_URL'] = $arItem["USER_HAVE_ACCESS"] &&
    ("N" === $arParams["HIDE_LINK_WHEN_NO_DETAIL"] || $arItem["DETAIL_TEXT"])
        ? htmlspecialcharsEx($arItem["DETAIL_PAGE_URL"]) : '#';

    // insert link from custom property
    if (!empty($arParams['LINK_BY_PROPERTY'])) {
        if ("Y" !== $arParams['USE_DETAIL_IS_PROP_EMPTY'] &&
            empty($arItem['PROPERTIES'][$arParams['LINK_BY_PROPERTY']]['VALUE'])) {
            $arItem['DETAIL_PAGE_URL'] = "#";
        } else {
            $arItem['DETAIL_PAGE_URL'] = $arItem['PROPERTIES'][$arParams['LINK_BY_PROPERTY']]['VALUE'];
            $arItem['LINK_ATTRS'] .= ' target="_blank"';
            $arItem['LINK_ATTRS'] .= ' rel="nofollow"';
        }
    }

    $arItem['EDIT_AREA_ID'] = $this->GetEditAreaId($arItem['ID']);

    if (strlen($arItem['DETAIL_PAGE_URL']) > 2 && $arParams['USE_GLOBAL_LINK']) {
        $arItem['ACTION']['AFTER_ARTICLE_BODY'] .= "\r\n"
          . sprintf('<a href="%s" class="global-link"%s></a>',
                $arItem['DETAIL_PAGE_URL'],
                $arItem['LINK_ATTRS']
            );
    }
}

/**
 * Lazy load || Infinity scroll
 */
$paramName = 'PAGEN_' . $arResult['NAV_RESULT']->NavNum;
$paramValue = $arResult['NAV_RESULT']->NavPageNomer;
$pageCount = $arResult['NAV_RESULT']->NavPageCount;

$arResult['MORE_ITEMS_LINK'] = '';
if ($arResult['NAV_RESULT']->NavPageCount <= 1) {
    $arParams['LAZY_LOAD'] = "N";
} elseif ($paramValue < $pageCount) {
    $arResult['MORE_ITEMS_LINK'] = htmlspecialcharsbx(
        $APPLICATION->GetCurPageParam(
            sprintf('%s=%s', $paramName, ++$paramValue),
            array($paramName, 'LAZY_LOAD')
        )
    );
}
