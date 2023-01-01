<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/**
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 * @global CUser $USER
 * @global CMain $APPLICATION
 */

if (!defined('REQUIRED_STAR')) define('REQUIRED_STAR', '<span class="text-danger">*</span>');

if ($USER->IsAuthorized()):

    echo '<p>' . GetMessage("MAIN_REGISTER_AUTH") . '</p>';

else:
?>
<form class="form form-main-register" method="post" action="<?= POST_FORM_ACTION_URI ?>" enctype="multipart/form-data"
      novalidate>
    <input type="hidden" name="register_submit_button" value="1">
    <?php if (mb_strlen($arResult["BACKURL"]) > 0): ?>
        <input type="hidden" name="backurl" value="<?= $arResult['BACKURL'] ?>"/>
    <?php endif ?>
    <div class="form-errors" data-role="error-messages">
        <?php

        if (count($arResult["ERRORS"]) > 0) {
            foreach ($arResult["ERRORS"] as $key => $error) {
                if (intval($key) == 0 && $key !== 0) {
                    $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#",
                        "&quot;" . GetMessage("REGISTER_FIELD_" . $key) . "&quot;", $error);
                }
            }

            ShowError(implode("<br />", $arResult["ERRORS"]));
        }

        ?>
    </div>

    <div class="form-success" data-role="success-messages"></div>

    <div class="form-fields">
    <?php

    foreach ($arResult["SHOW_FIELDS"] as $FIELD) {
        $isRequired = 'Y' === $arResult['REQUIRED_FIELDS_FLAGS'][$FIELD] ?? 'N';

        switch ($FIELD) {
        case 'LOGIN': ?>
            <div class="form-group form-group--login">
                <label class="form-group-label"><?= GetMessage("REGISTER_FIELD_LOGIN_LABEL") ?><?= $isRequired ? REQUIRED_STAR : '' ?></label>
                <input class="form-control form-group-input" type="text"
                       name="REGISTER[LOGIN]" value="<?= $arResult["VALUES"]["LOGIN"] ?>"
                       placeholder="<?= GetMessage("REGISTER_FIELD_LOGIN") ?>"
                       autocomplete="login"<?= $isRequired ? ' required' : '' ?> />
            </div>
        <?php
        break;

        case 'NAME':
        ?>
            <div class="form-group form-group--name">
                <label class="form-group-label"><?= GetMessage("REGISTER_FIELD_NAME_LABEL") ?><?= $isRequired ? REQUIRED_STAR : '' ?></label>
                <input class="form-control form-group-input" type="text"
                       name="REGISTER[NAME]" value="<?= $arResult["VALUES"]["NAME"] ?>"
                       placeholder="<?= GetMessage("REGISTER_FIELD_NAME") ?>"
                       autocomplete="name"<?= $isRequired ? ' required' : '' ?> />
            </div>
        <?php
        break;

        case 'PERSONAL_PHONE':
        ?>
            <div class="form-group form-group--personal_phone">
                <label class="form-group-label"><?= GetMessage("REGISTER_FIELD_PERSONAL_PHONE_LABEL") ?><?= $isRequired ? REQUIRED_STAR : '' ?></label>
                <input class="form-control form-group-input" type="tel"
                       name="REGISTER[PERSONAL_PHONE]" value="<?= $arResult["VALUES"]["PERSONAL_PHONE"] ?>"
                       placeholder="<?= GetMessage("REGISTER_FIELD_PERSONAL_PHONE") ?>"
                       autocomplete="tel"<?= $isRequired ? ' required' : '' ?> />
            </div>
        <?php
        break;

        case 'EMAIL':
        ?>
            <div class="form-group form-group--email">
                <label class="form-group-label"><?= GetMessage("REGISTER_FIELD_EMAIL_LABEL") ?><?= $isRequired ? REQUIRED_STAR : '' ?></label>
                <input class="form-control form-group-input" type="text"
                       name="REGISTER[EMAIL]" value="<?= $arResult["VALUES"]["EMAIL"] ?>"
                       placeholder="<?= GetMessage("REGISTER_FIELD_EMAIL") ?>"
                       autocomplete="email"<?= $isRequired ? ' required' : '' ?> />
                <?php if ('Y' === $arResult["USE_EMAIL_CONFIRMATION"]): ?>
                    <div class="form-group-tip"><?= GetMessage("REGISTER_EMAIL_WILL_BE_SENT"); ?></div>
                <?php endif; ?>
            </div>
        <?php
        break;

        case 'PASSWORD':
        ?>
            <div class="form-group form-group--password">
                <label class="form-group-label"><?= GetMessage('REGISTER_FIELD_PASSWORD_LABEL') ?><?= $isRequired ? REQUIRED_STAR : '' ?></label>
                <input class="form-control form-group-input" type="password" placeholder="<?= GetMessage('REGISTER_FIELD_PASSWORD') ?>"
                       name="REGISTER[PASSWORD]" value="<?= $arResult["VALUES"]["PASSWORD"] ?>"
                       style="background: inherit;"<?= $isRequired ? ' required' : '' ?>
                       autocomplete="off" onfocus="this.removeAttribute('readonly');" readonly/>
            </div>
        <?php
        break;

        case 'CONFIRM_PASSWORD':
        if ('Y' === $arParams['CONFIRM_PASSWORD']): ?>
            <div class="form-group form-group--confirm-password">
                <label class="form-group-label"><?= GetMessage('REGISTER_FIELD_CONFIRM_PASSWORD_LABEL') ?><?= $isRequired ? REQUIRED_STAR : '' ?></label>
                <input class="form-control form-group-input" type="text"
                       name="REGISTER[CONFIRM_PASSWORD]" value="<?= $arResult["VALUES"]["CONFIRM_PASSWORD"] ?>"
                       placeholder="<?= GetMessage('REGISTER_FIELD_CONFIRM_PASSWORD') ?>"
                       autocomplete="off"<?= $isRequired ? ' required' : '' ?> />
            </div>
        <?php else: ?>
        <input class="form-control form-group-input" type="hidden"
               name="REGISTER[CONFIRM_PASSWORD]" value="<?= $arResult["VALUES"]["CONFIRM_PASSWORD"] ?>"
               autocomplete="off"<?= $isRequired ? ' required' : '' ?> />
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var form = document.querySelector('.form-main-register')
                if (!form) return;

                var password = form.querySelector('[name="REGISTER[PASSWORD]"]');
                var confirm = form.querySelector('[name="REGISTER[CONFIRM_PASSWORD]"]');

                if (password && confirm) {
                  password.addEventListener('keyup', function (e) { confirm.value = e.target.value; });
                }
            });
        </script>
        <?php
        endif;
        break;

        default:
        if ($arUserField = ($arResult["USER_PROPERTIES"]["DATA"][$FIELD] ?? false)): ?>
            <div class="form-group form-group--<?= mb_strtolower($FIELD) ?>">
                <label class="form-group-label"><?= $arUserField['EDIT_FORM_LABEL'] ?><?= $isRequired ? REQUIRED_STAR : '' ?></label>
                <input class="form-control form-group-input" type="text"
                    name="<?= $FIELD ?>" value="<?= $arResult["VALUES"][$FIELD] ?>"
                    <?= $isRequired ? ' required' : '' ?> />
            </div>
        <?php else: ?>
            <div class="form-group form-group--<?= mb_strtolower($FIELD) ?>">
                <div class="form-group-label"><?= GetMessage("REGISTER_FIELD_{$FIELD}") ?><?= $isRequired ? REQUIRED_STAR : '' ?></div>
                <input class="form-control form-group-input" type="text"
                       name="REGISTER[<?= $FIELD ?>]" value="<?= $arResult["VALUES"][$FIELD] ?>"
                       <?= $isRequired ? ' required' : '' ?> />
            </div>
        <?php endif;
            break;
        }
    }

    if ('Y' == $arResult["USE_CAPTCHA"]): ?>
        <div class="form-group form-group--captcha" data-role="captcha-field">
            <?= $arResult['CAPTCHA_HTML'] ?>
        </div>
    <?php endif; ?>

        <div class="form-helpers">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="privacy_accept" value="Y" checked>
                    <span class="form-check-label">
                        Нажимая кнопку "Зарегистрироваться", я подтверждаю, что я ознакомился с
                        <a href="<?= $arParams['PRIVACY_LINK'] ?>"
                           target="_blank">политикой обработки персональных данных</a>
                        и даю согласие на обработку мои персональных данных
                    </span>
                </label>
            </div>
        </div>

        <div class="submit-wrap mt-2 mb-2">
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </div>
    </div>
</form>
<p class="text-center">
    <a class="login" href="/auth/?login=yes" rel="nofollow">Уже зарегистрированы? Войти</a>
</p>
<?php

endif;
