
<?php


        $sql = "
                INSERT INTO `firms` 
                (
                    `name` ,
                    `address1` ,
                    `address2` ,
                    `city` ,
                    `state` ,
                    `zipcode` ,
                    `attention` ,
                    `business_phone` ,
                    `fax_number` ,
                    `website` ,
                    `timezone` ,
                    `is_enabled` ,
                    `created` ,
                    `updated`
                )
                VALUES 
                (
                    ':name',     
                    ':address1', 
                    ':address2', 
                    ':city', 
                    ':state', 
                    ':zipcode', 
                    ':attention', 
                    ':business_phone', 
                    ':fax_number', 
                    ':website', 
                    ':timezone', 
                    ':is_enabled', 
                    ':created', 
                    ':updated'
                );";
        
                
        
        echo '<pre>';
        echo '2013-02-12 20:20:20 - INFO - ' . $sql . PHP_EOL;
        echo '2013-02-12 20:20:20 - INFO - Next message.' . PHP_EOL;

