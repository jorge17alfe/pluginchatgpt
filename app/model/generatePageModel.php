<?php

class GeneratePageModel
{
    public function Active()
    {
       
        global $wpdb;
        $table1 = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}generatepageadmin(
            `id` INT  NULL ,
            `name` VARCHAR(60) NULL,
            `status` ENUM('admin'),
            `surname` VARCHAR(60) NULL,
            `tokenOpenai` VARCHAR(100) NULL,
            `amazonID` VARCHAR(50) NULL,
            `email` VARCHAR(80) NULL,
            `gptversion` VARCHAR(30) NULL,
            PRIMARY KEY (`id`));
            ";

         $wpdb->query($table1);

         $table2 = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}generatepage(
            `id` INT NOT NULL AUTO_INCREMENT,
            `shortCode` VARCHAR(255) NULL,
            `title` VARCHAR(255) NULL,
            `consult` TEXT NULL,
            `content` TEXT NULL,
            PRIMARY KEY (`id`));
            ";

         $wpdb->query($table2);


         return ;
    }

    public function Select($table, $id)
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