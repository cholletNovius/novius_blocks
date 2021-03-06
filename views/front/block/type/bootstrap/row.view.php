<div class="row <?= $name ?>">
    <?php

    $rowSize = 12;
    foreach ($row as $colname => $col) {
        $colSize = \Arr::get($col, 'width', $rowSize);
        $rowSize -= $colSize;
        if ($rowSize <= 0) {
            $rowSize = 12;
        }

        $properties = array('class' => "columns col-md-$colSize");
        if (!empty($col['properties'])) {
            $properties = \Arr::merge($properties, $col['properties']);
        }

        $propertyList = array();

        array_walk($properties, function ($value, $key) use (&$propertyList) {
            $value          = str_replace("'", "\'", $value);
            $propertyList[] = "$key='$value'";
        });

        $properties = implode(' ', $propertyList);
        ?>
        <div <?//= $properties ?>>
            <?php
            if (!isset($col['fields'])) {
                echo \View::forge("novius_blocks::front/block/type/$type/row", array('row' => $col, 'type' => $type, 'name' => $colname, 'item' => $item), false);

            } else {
                echo \View::forge("novius_blocks::admin/block/preview/content", array('fields' => $col['fields'], 'item' => $item), false);
            }
            ?>
        </div>

    <?php
    }
    ?>
</div>