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
