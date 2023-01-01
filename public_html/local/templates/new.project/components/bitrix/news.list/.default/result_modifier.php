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

    /** @var array HTML entities */
    $arItem['VAR'] = array(
        'ARTICLE_CLASS' => call_user_func(function() use ($arParams, $arItem) {
            if(in_array($arParams['THUMBNAIL_POSITION'], array('LEFT', 'RIGHT'))) {
                return 'media ' . $arParams['ITEM_CLASS'];
            }

            return $arParams['ITEM_CLASS'];
        }),
        'PICT' => function() use ($arParams, &$arItem) {
            $strPict = '';
            $strPictURL = isset($arParams['PICTURE_URL']) && "DETAIL_PICTURE" === $arParams['PICTURE_URL'] ?
                htmlspecialcharsEx($arItem["DETAIL_PICTURE"]["SRC"]) : $arItem['DETAIL_PAGE_URL'];
            $strPictClass = htmlspecialcharsEx($arParams['ITEM_CLASS']) . '__pict';
            switch ($arParams['THUMBNAIL_POSITION']) {
                case 'RIGHT':
                case 'FLOAT_R':
                    $strPictClass = 'alignright ' . $strPictClass;
                    break;

                case 'LEFT':
                case 'FLOAT_L':
                    $strPictClass = 'alignleft ' . $strPictClass;
                    break;
            }

            if ( ! empty($arItem["PREVIEW_PICTURE"]["SRC"])) {
                // create img element
                $strPict = sprintf('<img src="%s" alt="%s">',
                    htmlspecialcharsEx($arItem["PREVIEW_PICTURE"]["SRC"]),
                    htmlspecialcharsEx($arItem["NAME"])
                );

                if( strlen($strPictURL) > 2 ) {
                    // wrap to link
                    $strPict = sprintf('<a href="%s"%s>%s</a>',
                        $strPictURL,
                        "DETAIL_PICTURE" !== $arParams['PICTURE_URL'] ? $arItem['LINK_ATTRS'] : '',
                        $strPict
                    );
                }
            }

            // wrap to module box
            return sprintf('<div class="%s">%s</div>',
                $strPictClass,
                $strPict
            );
        },

        'NAME' => function() use ($arParams, $arItem) {
            $strNameClass = $arParams['ITEM_CLASS'] . '__name';

            if( strlen($arItem['DETAIL_PAGE_URL']) > 2 ) {
                // wrap to module with link
                return sprintf('<a href="%4$s" class="%3$s d-block"%5$s><%1$s>%2$s</%1$s></a>',
                    htmlspecialcharsEx($arParams["NAME_TAG"]),
                    $arItem["NAME"], // strip_tags?
                    htmlspecialcharsEx($strNameClass),
                    $arItem['DETAIL_PAGE_URL'],
                    $arItem['LINK_ATTRS']
                );
            }
            else {
                // wrap to module box
                return sprintf('<%1$s class="%3$s">%2$s</%1$s>',
                    htmlspecialcharsEx($arParams["NAME_TAG"]),
                    $arItem["NAME"], // strip_tags?
                    htmlspecialcharsEx($arParams['ITEM_CLASS'] . '__name')
                );
            }
        },

        'DATE' => function() use ($arParams, $arItem) {
            $date = $arItem["DISPLAY_ACTIVE_FROM"] ? strip_tags($arItem["DISPLAY_ACTIVE_FROM"]) : '';

            // wrap to module box
            return sprintf('<div class="%s__date">%s</div>',
                htmlspecialcharsEx($arParams['ITEM_CLASS']),
                $date
            );
        },

        'DESC' => function() use ($arParams, $arItem) {
            $text = $arItem["PREVIEW_TEXT"] ? $arItem["PREVIEW_TEXT"] : '';

            // wrap to module box
            return sprintf('<div class="%s__desc">%s</div>',
                htmlspecialcharsEx($arParams['ITEM_CLASS']),
                $text
            );
        },
        // @TODO: check element class
        'MORE' => function() use ($arParams, $arItem) {
            /**
             * @todo in future
             */
            $arItem['MORE_LINK_TEXT'] = $arParams["MORE_LINK_TEXT"];
            // if( !empty($arItem['PROPERTIES'][ $arParams['EXTERNAL_LINK_PROPERTY'] ]['VALUE']) ) {
            //     $arItem['DETAIL_PAGE_URL'] = $arItem['PROPERTIES'][ $arParams['EXTERNAL_LINK_PROPERTY'] ]['VALUE'];
            //     $arItem['MORE_LINK_TEXT'] = 'Читать в источнике';
            // }

            if( empty($arItem["MORE_LINK_TEXT"]) ) return '';
            if( "Y" === $arParams["HIDE_LINK_WHEN_NO_DETAIL"] || empty($arItem["DETAIL_TEXT"]) ) return '';

            if( strlen($arItem['DETAIL_PAGE_URL']) > 2 ) {
                return sprintf('<div class="%1$s__more"><a class="btn" href="%2$s"%3$s>%4$s</a></div>',
                    htmlspecialcharsEx($arParams['ITEM_CLASS']),
                    $arItem['DETAIL_PAGE_URL'],
                    $arItem['LINK_ATTRS'],
                    $arItem["MORE_LINK_TEXT"]
                );
            }

            return '';
        },

        'SECT' => function() use ($arParams, $arItem) {
            if (empty($arItem['IBLOCK_SECTION_ID'])) return '';

            // Get section name by id
            $arSection = \Bitrix\Iblock\SectionTable::getList(array(
                'select' => array('ID', 'NAME'),
                'filter' => array('=ID' => $arItem['IBLOCK_SECTION_ID']),
            ))->fetch();

            $strSectName = $arSection['NAME'] ? strip_tags($arSection['NAME']) : '';

            return sprintf('<div class="%s__sect">%s</div>',
                htmlspecialcharsEx($arParams['ITEM_CLASS']),
                $strSectName
            );
        },
        // @TODO:
        'PROPERTIES' => call_user_func(function() use ($arParams, $arItem) {
            $properties = array();
            return $properties;
        }),
    );

    /**
     * Properties
     */
    foreach ($arItem['DISPLAY_PROPERTIES'] as $propCode => $arProperty) {
            if( is_array($arProperty['VALUE']) ) {
                $arProperty['VALUE'] = implode(', ', $arProperty['VALUE']);
            }

            if($arItem["PREVIEW_TEXT"]) {
                $arItem["VAR"]['PROP_' . $propCode] = $arProperty['VALUE'];
            }

            $arItem["VAR"]['PROP_' . $propCode] = sprintf('<div class="%1$s__prop %1$s-prop %1$s-prop__%2$s">%3$s</div>',
                htmlspecialcharsEx($arParams['ITEM_CLASS']),
                htmlspecialcharsEx(strtolower($propCode)),
                $arItem["VAR"]['PROP_' . $propCode]
            );
    }

    $arItem['ACTION']['BEFORE_ARTICLE_BODY'] = in_array($arParams['THUMBNAIL_POSITION'],
        array('LEFT', 'FLOAT_L')) ? $arItem['VAR']['PICT'] : '';

    $arItem['ACTION']['AFTER_ARTICLE_BODY'] = in_array($arParams['THUMBNAIL_POSITION'],
        array('RIGHT', 'FLOAT_R')) ? $arItem['VAR']['PICT'] : '';

    if (strlen($arItem['DETAIL_PAGE_URL']) > 2 && $arParams['USE_GLOBAL_LINK']) {
        $arItem['ACTION']['AFTER_ARTICLE_BODY'] .= "\r\n"
          . sprintf('<a href="%s" class="global-link"%s></a>',
                $arItem['DETAIL_PAGE_URL'],
                $arItem['LINK_ATTRS']
            );
    }
}

$sort = array_flip( $arParams['SORT_ELEMENTS'] );

foreach ($arResult["ITEMS"] as &$arItem) {
    $arItem['VAR']['SHOW_ELEMENTS'] = function() use ($sort, $arItem) {
        foreach ($sort as $elem) {
            if (isset($arItem['VAR'][$elem])) echo $arItem['VAR'][$elem];
        }
    };
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
