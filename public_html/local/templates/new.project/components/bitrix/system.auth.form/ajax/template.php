<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
if ('login' === $arResult["FORM_TYPE"]): ?>
    <form name="custom-auth-form" method="post" action="">
        <?php

        if (mb_strlen($arResult["BACKURL"]) > 0) {
            echo '<input type="hidden" name="backurl" value="' . $arResult["BACKURL"] . '" />' . "\n";
        }

        foreach ($arResult["POST"] as $key => $value) {
            echo '<input type="hidden" name="' . $key . '" value="' . $value . '" />' . "\n";
        }

        ?>
        <input type="hidden" name="AUTH_FORM" value="Y"/>
        <input type="hidden" name="TYPE" value="AUTH"/>

        <div class="custom-auth__errors mb-3 text-danger" data-entity="error-messages">
            <?php if ('Y' === $arResult['SHOW_ERRORS'] && $arResult['ERROR'] && $arResult['ERROR_MESSAGE']) {
                ShowMessage($arResult['ERROR_MESSAGE']);
            } ?>
        </div>

        <label class="form-group mb-3 form-group--name">
            <div class="form-group-label"><?= GetMessage("AUTH_LOGIN") ?></div>
            <input type="text"
                   name="USER_LOGIN"
                   class="form-control form-group-input"
                   placeholder="Введите ваш логин"
                   autocomplete="username"
                   maxlength="50"
                   value="<?= $arResult['REQUEST']['USER_LOGIN'] ?>"/>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var loginCookie = BX.getCookie("<?= CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"]) ?>");
                    if (loginCookie) {
                        var form = document.forms["custom-auth-form"];
                        var loginInput = form.elements["USER_LOGIN"];
                        loginInput.value = loginCookie;
                    }
                });
            </script>
        </label>

        <div class="form-group mb-3 form-group--pwd">
            <div class="form-group-label"><?= GetMessage("AUTH_PASSWORD") ?></div>
            <input type="password"
                   name="USER_PASSWORD"
                   class="form-control form-group-input"
                   placeholder="Введите пароль"
                   autocomplete="current-password"
                   maxlength="50"
                   value=""/>
        </div>

        <div class="form-group mb-3 form-group--remember">
            <?php if ("Y" === $arResult["STORE_PASSWORD"]): ?>
                <label class="form-check">
                    <input
                            type="checkbox"
                            name="USER_REMEMBER"
                            class="form-check-input"
                            value="Y"
                        <?= 'Y' === $arResult['REQUEST']['USER_REMEMBER'] ? 'checked="true"' : '' ?> />

                    <span class="form-check-label"><?= GetMessage("AUTH_REMEMBER_ME") ?></span>
                </label>
            <? endif ?>
        </div>

        <? if ($arResult["CAPTCHA_CODE"] && 'Y' == $arResult["USE_CAPTCHA"]) : ?>
            <div class="form-group">
                <div class="form-group form-captcha">
                    <label class="d-flex justify-content-between"><?= GetMessage("REGISTER_CAPTCHA_PROMT") ?>:
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["CAPTCHA_CODE"] ?>"
                             width="180" height="40" alt="CAPTCHA"/></label>
                    <input type="hidden" name="captcha_sid" value="<?= $arResult["CAPTCHA_CODE"] ?>"/>
                    <input type="text" name="captcha_word" maxlength="50" value="" class="form-control form-group-input"
                           autocomplete="off"/>
                </div>
            </div>
        <?php endif; ?>

        <p class="custom-auth__action">
            <button class="btn btn-primary" type="submit"><?= GetMessage("AUTH_LOGIN_BUTTON") ?></button>
        </p>

        <p class="custom-auth__other">
            <?php if ('Y' === $arResult["NEW_USER_REGISTRATION"]): ?>
                <a class="register" href="<?= $arParams['REGISTER_URL'] ?>" rel="nofollow">Регистрация</a> |
            <?php endif ?>

            <a class="forgot" href="<?= $arParams['FORGOT_PASSWORD_URL'] ?>" rel="nofollow">Забыли пароль?</a>
        </p>
    </form>
<?php else: ?>
    <form action="<?= $arResult["AUTH_URL"] ?>">
        <table width="95%">
            <tr>
                <td align="center">
                    <?= $arResult["USER_NAME"] ?><br/>
                    [<?= $arResult["USER_LOGIN"] ?>]<br/>
                    <a href="<?= $arResult["PROFILE_URL"] ?>"
                       title="<?= GetMessage("AUTH_PROFILE") ?>"><?= GetMessage("AUTH_PROFILE") ?></a><br/>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <? foreach ($arResult["GET"] as $key => $value): ?>
                        <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"/>
                    <? endforeach ?>
                    <?= bitrix_sessid_post() ?>
                    <input type="hidden" name="logout" value="yes"/>
                    <input type="submit" name="logout_butt" value="<?= GetMessage("AUTH_LOGOUT_BUTTON") ?>"/>
                </td>
            </tr>
        </table>
    </form>
<?php endif ?>