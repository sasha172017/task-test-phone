<?php


namespace Database\Migration;

use Database\DB;

class Migration_create_table_phone_country_code
{
    public function up()
    {
        $connection = DB::getInstance();
        $sql = "create table number(
        	id int auto_increment,
	        value varchar(255) not null,
	        constraint number_pk
		    primary key (id));
		    create table country_code(
        	id int auto_increment,
	        value varchar(255) not null,
	        constraint number_pk
		    primary key (id));
		    alter table number
        	add country_code_id int not null;
            alter table number
	        add constraint number_country_code
		    foreign key (country_code_id) references country_code (id)
			on delete cascade;
		    ";
        try {
            $connection->exec($sql);
            print("Created Phone Table.\n");
            print("Created Country Code Table.\n");

        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
}