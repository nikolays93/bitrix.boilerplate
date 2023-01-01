<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

?>
<form class="form form-result-new" method="POST" enctype="multipart/form-data"
      name="<?= $arResult["WEB_FORM_NAME"] ?>" action="<?= POST_FORM_ACTION_URI ?>"
      data-area="<?= $arResult['WEB_FORM_AREA_ID'] ?>" novalidate>
    <input type="hidden" name="WEB_FORM_ID" value="<?= $arParams["WEB_FORM_ID"] ?>">
    <input type="hidden" name="web_form_apply" value="Y">
    <?= bitrix_sessid_post() ?>

    <div class="form__fields">
        <label class="form-group d-block mb-3">
            <div class="mb-1">Тестовое поле</div>
            <input type="text" class="form-control" placeholder=""
                   name="<?= $arResult['arAnswers']['TEXT'][0]['NAME'] ?>"<?= $arResult['arAnswers']['TEXT'][0]['REQUIRED'] ?>>
            <small class="form-group-error text-danger"></small>
        </label>
    </div>

    <div class="form__result text-danger">
        <?= implode("<br>\n", $arResult["FORM_ERRORS"] ?: []) ?>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const formEl = document.querySelector('[data-area="<?= $arResult['WEB_FORM_AREA_ID'] ?>"]')

        new window.FormResultNew(formEl, window.FieldTypeList, {
            field: '.form-group', // input wrapper
            error: '.form-group-error' // message inner field
        })
    });
</script>
