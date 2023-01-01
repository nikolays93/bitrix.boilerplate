<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arResult */
$this->getComponent()->SetResultCacheKeys(['ERROR_MESSAGE']);

$obRequest = \Bitrix\Main\Context::getCurrent()->getRequest();
$arResult['REQUEST'] = [
    'USER_LOGIN' => $obRequest->get('USER_LOGIN'),
    'USER_REMEMBER' => $obRequest->get('USER_REMEMBER'),
];
