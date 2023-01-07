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
if (empty($arParams['ROW_CLASS'])) $arParams['ROW_CLASS'] = 'row';
if (empty($arParams['ITEM_CLASS'])) $arParams['ITEM_CLASS'] = 'item';
if (empty($arParams["NAME_TAG"])) $arParams["NAME_TAG"] = 'h3';
if (empty($arParams['ITEM_TEMPLATE'])) $arParams["ITEM_TEMPLATE"] = 'news';

// define list class
$arSectionClass = array('news-list');
if (!empty($arParams['ITEM_CLASS'])) $arSectionClass[] = $arParams['ITEM_CLASS'] . "-list";
if (!empty($arParams['IBLOCK_CODE'])) $arSectionClass[] = "news-list_type_" . $arParams['IBLOCK_CODE'];
if (!empty($arParams['IBLOCK_ID'])) $arSectionClass[] = "news-list_id_" . $arParams['IBLOCK_ID'];

$arResult['SECTION_CLASS'] = implode(' ', $arSectionClass);

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
