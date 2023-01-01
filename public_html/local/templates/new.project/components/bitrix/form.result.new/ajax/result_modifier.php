<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$this->getComponent()->SetResultCacheKeys(['FORM_ERRORS']);

$prepareAnswer = function (&$arAnswer, $i, $arQuestion) {
    $arAnswer['NAME'] = "form_{$arAnswer['FIELD_TYPE']}_{$arAnswer['ID']}";
    $arAnswer['REQUIRED'] = ('Y' !== $arQuestion['REQUIRED']) ? '' : ' required="true"';
};

foreach ($arResult['arAnswers'] as $name => $arQuestion) {
    array_walk($arResult['arAnswers'][$name], $prepareAnswer, $arResult['arQuestions'][$name]);
}

$arResult['WEB_FORM_AREA_ID'] = $arParams['WEB_FORM_ID'] . '-' . \Bitrix\Main\Security\Random::getString(6);
