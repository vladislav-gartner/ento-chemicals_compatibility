<?php

return [
    'label' => 'Разработчику', 'icon' => 'fa fa-wrench', 'header' => true, 'url' => ['/entity/index'],
    'items' => [
        ['label' => 'Gii', 'icon' => 'icofont icofont-automation', 'url' => ['/gii'], 'linkOptions' => ['target' => '_blank'], 'template' => '<a href="{url}" target="_blank">{icon} {label}</a>',],
        '<li class="divider"></li>',
        ['label' => 'Проекты', 'icon' => 'fa fa-suitcase', 'url' => ['/kit/project/index']],
        '<li class="divider"></li>',
        ['label' => 'Сущности', 'icon' => 'fa fa-wrench', 'url' => ['/kit/entity/index']],
        ['label' => 'Сущности - Поля', 'icon' => 'fa fa-book', 'url' => ['/kit/entity-field/index']],
        ['label' => 'Сущности - Группы полей', 'icon' => 'fa fa-book', 'url' => ['/kit/entity-field-group/index']],
        ['label' => 'Сущности - Исключения', 'icon' => 'fa fa-book', 'url' => ['/kit/entity-exclude/index']],
        ['label' => 'Сущности - Субмодели', 'icon' => 'fa fa-book', 'url' => ['/kit/entity-assignment/index']],
        '<li class="divider"></li>',
        ['label' => Yii::t('app','Entity Partials'), 'icon' => 'icofont icofont-layout', 'url' => ['/kit/entity-partial/index']],
        '<li class="divider"></li>',
        ['label' => Yii::t('app','Depend Nesteds'), 'icon' => 'icofont icofont-chart-flow', 'url' => ['/kit/depend-nested/index']],
        '<li class="divider"></li>',
        ['label' => 'Фильтр таблиц', 'icon' => 'fa fa-filter', 'url' => ['/kit/filter-table/index']],
        ['label' => 'Типы фильтр таблиц', 'icon' => 'fa fa-book', 'url' => ['/kit/filter-table-type/index']],
        '<li class="divider"></li>',
        ['label' => 'Поля', 'icon' => 'fa fa-book', 'url' => ['/kit/field/index']],
        ['label' => 'Типы полей', 'icon' => 'fa fa-book', 'url' => ['/kit/field-type/index']],
        '<li class="divider"></li>',
        ['label' => 'Действия', 'icon' => 'fa fa-book', 'url' => ['/kit/access-action/index']],
        ['label' => 'Группы', 'icon' => 'fa fa-book', 'url' => ['/kit/access-group/index']],
        ['label' => 'Группы - Действия', 'icon' => 'fa fa-book', 'url' => ['/kit/access-group-action/index']],
        ['label' => 'Сущности - Группы', 'icon' => 'fa fa-book', 'url' => ['/kit/access/index']],
        '<li class="divider"></li>',
        ['label' => 'Статусы', 'icon' => 'fa fa-book', 'url' => ['/kit/status-constant/index']],
        ['label' => 'Стили статусов', 'icon' => 'fa fa-book', 'url' => ['/kit/status-style/index']],
        ['label' => 'Наборы статусов', 'icon' => 'fa fa-book', 'url' => ['/kit/status-bundle/index']],
        ['label' => 'Наборы - Константы', 'icon' => 'fa fa-book', 'url' => ['/kit/status-bundle-constant/index']],
        ['label' => 'Сущности - Наборы', 'icon' => 'fa fa-book', 'url' => ['/kit/status-entity/index']],
    ]
];