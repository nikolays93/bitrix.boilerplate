<?php

namespace Boilerplate\Module\ORM;

use Bitrix\Main;
use Bitrix\Main\Entity;

/**
 * Class Boilerplate\Module\ORM\DataTable
 *
 * Fields:
 * <ul>
 * <li> ID int
 * <li> ACTIVE bool
 * <li> CODE string
 * <li> TITLE string
 * <li> SORT int optional default 500
 * <li> DATE_UPDATE datetime default 'CURRENT_TIMESTAMP'
 * </ul>
 **/

class DataTable extends Entity\DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName()
	{
		return 'boilerplate_module';
	}

	/**
	 * Returns entity map definition.
	 *
	 * @return array
	 */
	public static function getMap()
	{
		return [
            'ID' => new Entity\IntegerField('ID', array(
                'primary' => true,
                'autocomplete' => true,
            )),
            'ACTIVE' => new Main\Entity\BooleanField('ACTIVE', array(
                'default_value' => 'Y',
                'values'        => array('N', 'Y'),
                'title'         => 'Активность',
            )),
            'CODE' => new Entity\StringField('CODE', array(
                'title' => 'Код',
                'validation' => function() {
                    return array(
                        new Main\Entity\Validator\Length(null, 50),
                        new Main\Entity\Validator\RegExp('/^[A-Za-zА-Яа-я0-9-._]+$/'),
                        new Main\Entity\Validator\Unique,
                    );
                },
            )),
            'TITLE' => new Entity\StringField('TITLE', array(
                'title' => 'Заголовок',
                'required' => true,
            )),
            'SORT' => new Entity\IntegerField('SORT', array(
                'title' => 'Сортировка',
                'default_value' => 500,
            )),
            'DATE_UPDATE' => new Entity\DateTimeField('DATE_UPDATE', array(
                'title' => 'Дата изменения',
                'default_value' => new Main\Type\DateTime,
            )),
        ];
	}
}