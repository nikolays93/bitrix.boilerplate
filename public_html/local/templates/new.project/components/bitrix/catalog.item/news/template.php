<?php
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$arItemTemplate = new CBitrixNewsItemTemplate($arParams, $arResult['ITEM']); ?>
<article class="<?= $arParams['ITEM_CLASS'] ?>" id="<?= $arResult['ITEM']['EDIT_AREA_ID'] ?>">
    <?= $arItemTemplate->getPicture() ?>

    <div class="media-body <?= $arParams['ITEM_CLASS'] ?>__body">
        <?= $arItemTemplate->getName(); ?>
        <?= $arItemTemplate->getDescription(); ?>
        <?= $arItemTemplate->getMoreLink(); ?>
        <?= $arItemTemplate->getDate(); ?>
        <?= $arItemTemplate->getSectionName(); ?>
    </div>
    <?= $arResult['ITEM']['ACTION']['AFTER_ARTICLE_BODY'] ?>
</article>