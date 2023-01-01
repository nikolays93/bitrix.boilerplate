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

$this->setFrameMode(true);

?>
<section class='<?= $arResult['VAR']['SECTION_CLASS'] ?>'>
    <?php

    if ("Y" == $arParams['LAZY_LOAD'] && !empty($_GET['LAZY_LOAD'])) {
        echo "<!--RestartBuffer-->";
    }
    // elseif( $arParams["DISPLAY_TOP_PAGER"] ) {
    //     printf('<div class="%1$s_%2$s__pager %1$s_%2$__pager_top">%3$s</div>',
    //         $arParams['IBLOCK_CODE'],
    //         $arParams['ITEM_CLASS'],
    //         $arResult["NAV_STRING"]
    //     );
    // }

    ?>
    <div class="<?= $arResult['VAR']['ROW_CLASS'] ?>">
        <?php foreach ($arResult["ITEMS"] as $arItem): ?>
            <article class="<?= $arItem['VAR']['ARTICLE_CLASS'] ?>" id="<?= $arItem['EDIT_AREA_ID'] ?>">
                <?= $arItem['ACTION']['BEFORE_ARTICLE_BODY'] ?>
                <div class="media-body <?= $arParams['ITEM_CLASS'] ?>__body">
                    <?php

                    /**
                     * Show elements by SORT_ELEMENTS param include: PICT, NAME, DESC, MORE, DATE, SECT
                     * You may use <?= $PICT ?> instead this function
                     */
                    $arItem['VAR']['SHOW_ELEMENTS']();

                    ?>
                </div>
                <?= $arItem['ACTION']['AFTER_ARTICLE_BODY'] ?>
            </article>
        <? endforeach ?>
    </div><!-- .<?= $arResult['VAR']['ROW_CLASS'] ?> -->
    <?php

    if ($arParams["DISPLAY_BOTTOM_PAGER"]) {
        printf('<div class="%1$s_%2$s__pager %1$s_%2$__pager_bottom">%3$s</div>',
            $arParams['IBLOCK_CODE'],
            $arParams['ITEM_CLASS'],
            $arResult["NAV_STRING"]
        );
    }

    if ($arResult['MORE_ITEMS_LINK'] && "Y" == $arParams['LAZY_LOAD']) {
        ?>
        <div class="ajax-pager-wrap">
            <a data-more class="btn btn-primary" href="<?= $arResult['MORE_ITEMS_LINK'] ?>">Загрузить ещё</a>
        </div>
        <?php
    }

    if ("Y" == $arParams['LAZY_LOAD'] && !empty($_GET['LAZY_LOAD'])) {
        echo '<!--RestartBuffer-->';
    }

    ?>
</section>
