<?php
/**
 * @var CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

if ("Y" == $arParams['LAZY_LOAD'] && !empty($_GET['LAZY_LOAD'])) {
    $content = ob_get_contents();
    ob_end_clean();

    $APPLICATION->RestartBuffer();

    @list(, $content_html) = explode('<!--RestartBuffer-->', $content);
    echo $content_html;
    die();
}

if ("Y" == $arParams['LAZY_LOAD']):?>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            var $section = $('.<?= implode('.', explode(' ', $arResult['SECTION_CLASS'])) ?>');
            var wrapperClass = '.<?= implode('.', explode(' ', $arParams['ROW_CLASS'])) ?>';
            var $wrapper = $(wrapperClass, $section);

            var ajaxPagerLoadingTpl = '<span class="ajax-pager-loading">Загрузка…</span>';
            var ajaxBusy = false;

            <?php if("Y" == $arParams['INFINITY_SCROLL']):?>
            var $window = $(window);
            $window.on('scroll', function () {
                var wrapperOffsetBottom = $wrapper.offset().top + $wrapper.height();
                var windowOffsetBottom = $window.scrollTop() + $window.height();

                if (windowOffsetBottom > wrapperOffsetBottom && !ajaxBusy) {
                    $("[data-more]", $section).trigger('click');
                }
            });
            <?php endif?>

            $section.on('click', "[data-more]", function (event) {
                event.preventDefault();
                ajaxBusy = true;

                var $loadingLabel = $(ajaxPagerLoadingTpl);

                $(this).parent().append($loadingLabel);

                $.get($(this).attr('href'), {'LAZY_LOAD': 'Y'}, function (newElements) {
                    var $new = $(newElements);
                    $wrapper = $(wrapperClass, $section);

                    $new.each(function (index, el) {
                        var $el = $(el);

                        if ($el.hasClass('row')) {
                            $el.prepend($wrapper.html());
                        }
                    });

                    $section.html($new);
                    // $wrapper.append(newElements);
                    // $loadingLabel.remove();

                    ajaxBusy = false;
                });
            });
        });
    </script>
<?php endif ?>