SELECT `line`.`id` as 'line_id', `line`.`number` as 'line_number', `racks`.`name` as 'rack_name'
, `slots`.`name` as 'slot_name', `models`.`name` as 'model_name'
, (CASE WHEN `racks`.`type` LIKE 'adapter' THEN `adapters`.`name` ELSE `documents`.`name`END) as 'keypart NO', `slots`.`running`

FROM `slots`
INNER JOIN `models` ON `models`.`id` = `slots`.`id_model`
INNER JOIN `adapters` ON `models`.`id_adapter` = `adapters`.`id`
INNER JOIN `documents` ON `models`.`id_document` = `documents`.`id`
INNER JOIN `racks` ON `racks`.`id` = `slots`.`id_rack`
INNER JOIN `line` ON `line`.`id` = `racks`.`id_line`

ORDER BY rack_name