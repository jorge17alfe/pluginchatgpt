<?php

class GeneratePageModel
{
    public function Active()
    {
       
        global $wpdb;
        $table1 = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}generatepageadmin(
            `id` INT  NULL ,
            `tokenOpenai` VARCHAR(100) NULL,
            `amazonID` VARCHAR(50) NULL,
            `gptversion` VARCHAR(30) NULL,
            PRIMARY KEY (`id`));
            ";

         $wpdb->query($table1);

         return ;
    }

    public function SelectAllId($table, $id)
    {
        global $wpdb;
        $query = "SELECT * FROM $table WHERE id = $id";
        return $wpdb->get_results($query, ARRAY_A);
    }
    public function Insert($table, $data)
    {
        global $wpdb;
        $wpdb->insert($table, $data);
    }


  
    
 
}