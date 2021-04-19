<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared($this->createTrigger());   
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER IF EXISTS `users_after_deleting`");   
    }

    private function createTrigger(){
        return"CREATE TRIGGER users_after_deleting AFTER DELETE ON users FOR EACH ROW BEGIN DECLARE admin_email VARCHAR(255);DECLARE admin_name VARCHAR(255); DECLARE message TEXT; SELECT u.name, u.email INTO admin_name, admin_email FROM users u WHERE role = 'a' LIMIT 1; SET message = CONCAT('Si è cancellato l\'utente ', OLD.name, ' la cui mail è: ', OLD.email);INSERT INTO `email_queue` ( `user_id`, `recipient_name`, `recipient_email`, `subject`, `body`, `type` ) VALUES ( OLD.id, admin_name, admin_email, 'Nuova cancellazione utente', message, 'user_deleted' ); END";
    }
}