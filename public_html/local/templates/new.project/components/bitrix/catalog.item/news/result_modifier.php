<?php

use Bitrix\Iblock\SectionTable;

if (!class_exists('CBitrixNewsItemTemplate')):
    class CBitrixNewsItemTemplate
    {
        public $arParams;
        public $arItem;

        public function __construct($arParams, $arItem)
        {
            $this->arParams = $arParams;
            $this->arItem = $arItem;
        }

        public function getPicture()
        {
            $strPict = '';
            $strPictURL = isset($this->arParams['PICTURE_URL']) && "DETAIL_PICTURE" === $this->arParams['PICTURE_URL'] ?
                htmlspecialcharsEx($this->arItem["DETAIL_PICTURE"]["SRC"]) : $this->arItem['DETAIL_PAGE_URL'];

            if (!empty($this->arItem["PREVIEW_PICTURE"]["SRC"])) {
                // create img element
                $strPict = sprintf('<img src="%s" alt="%s">',
                    htmlspecialcharsEx($this->arItem["PREVIEW_PICTURE"]["SRC"]),
                    htmlspecialcharsEx($this->arItem["NAME"])
                );

                if (strlen($strPictURL) > 2) {
                    // wrap to link
                    $strPict = sprintf('<a href="%s"%s>%s</a>',
                        $strPictURL,
                        "DETAIL_PICTURE" !== $this->arParams['PICTURE_URL'] ? $this->arItem['LINK_ATTRS'] : '',
                        $strPict
                    );
                }
            }

            // wrap to module box
            return sprintf('<div class="%s">%s</div>',
                htmlspecialcharsEx($this->arParams['ITEM_CLASS']) . '__pict',
                $strPict
            );
        }

        public function getName()
        {
            $strNameClass = $this->arParams['ITEM_CLASS'] . '__name';

            if (strlen($this->arItem['DETAIL_PAGE_URL']) > 2) {
                // wrap to module with link
                return sprintf('<a href="%4$s" class="%3$s d-block"%5$s><%1$s>%2$s</%1$s></a>',
                    htmlspecialcharsEx($this->arParams["NAME_TAG"]),
                    $this->arItem["NAME"], // strip_tags?
                    htmlspecialcharsEx($strNameClass),
                    $this->arItem['DETAIL_PAGE_URL'],
                    $this->arItem['LINK_ATTRS']
                );
            } else {
                // wrap to module box
                return sprintf('<%1$s class="%3$s">%2$s</%1$s>',
                    htmlspecialcharsEx($this->arParams["NAME_TAG"]),
                    $this->arItem["NAME"], // strip_tags?
                    htmlspecialcharsEx($this->arParams['ITEM_CLASS'] . '__name')
                );
            }
        }

        public function getDate()
        {
            $date = $this->arItem["DISPLAY_ACTIVE_FROM"] ? strip_tags($this->arItem["DISPLAY_ACTIVE_FROM"]) : '';

            // wrap to module box
            return sprintf('<div class="%s__date">%s</div>',
                htmlspecialcharsEx($this->arParams['ITEM_CLASS']),
                $date
            );
        }

        function getDescription()
        {
            $text = $this->arItem["PREVIEW_TEXT"] ? $this->arItem["PREVIEW_TEXT"] : '';

            // wrap to module box
            return sprintf('<div class="%s__desc">%s</div>',
                htmlspecialcharsEx($this->arParams['ITEM_CLASS']),
                $text
            );
        }

        public function getMoreLink()
        {
            $this->arItem['MORE_LINK_TEXT'] = $this->arParams["MORE_LINK_TEXT"];

            if (empty($this->arItem["MORE_LINK_TEXT"])) return '';
            if ("Y" === $this->arParams["HIDE_LINK_WHEN_NO_DETAIL"] || empty($this->arItem["DETAIL_TEXT"])) return '';

            if (strlen($this->arItem['DETAIL_PAGE_URL']) > 2) {
                return sprintf('<div class="%1$s__more"><a class="btn" href="%2$s"%3$s>%4$s</a></div>',
                    htmlspecialcharsEx($this->arParams['ITEM_CLASS']),
                    $this->arItem['DETAIL_PAGE_URL'],
                    $this->arItem['LINK_ATTRS'],
                    $this->arItem["MORE_LINK_TEXT"]
                );
            }

            return '';
        }

        function getSectionName()
        {
            if (empty($this->arItem['IBLOCK_SECTION_ID'])) return '';

            // Get section name by id
            $arSection = SectionTable::getList(array(
                'select' => array('ID', 'NAME'),
                'filter' => array('=ID' => $this->arItem['IBLOCK_SECTION_ID']),
            ))->fetch();

            $strSectName = $arSection['NAME'] ? strip_tags($arSection['NAME']) : '';

            return sprintf('<div class="%s__sect">%s</div>',
                htmlspecialcharsEx($this->arParams['ITEM_CLASS']),
                $strSectName
            );
        }

        function getProperties()
        {
            $properties = [];
            foreach ($this->arItem['DISPLAY_PROPERTIES'] as $propCode => $arProperty) {
                if (is_array($arProperty['VALUE'])) {
                    $arProperty['VALUE'] = implode(', ', $arProperty['VALUE']);
                }

                $properties[] = sprintf('<div class="%1$s__prop %1$s-prop %1$s-prop__%2$s">%3$s</div>',
                    htmlspecialcharsEx($this->arParams['ITEM_CLASS']),
                    htmlspecialcharsEx(strtolower($propCode)),
                    $arProperty['VALUE']
                );
            }

            return $properties;
        }
    }
endif;