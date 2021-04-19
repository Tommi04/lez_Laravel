<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateNewsletterView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->createTicketsStatsView());        
        DB::statement($this->createDetailsView());
        DB::statement($this->createNewsletterUserView());
        //la rimuovo perchè mi serve una VIEW  e non una TABLE
        /*Schema::create('newsletter_view', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //DROP inutili qua non funzionano non so perchè
        //ho messo CREATE OR REPLACE
        DB::statement($this->dropTicketStatsView());
        DB::statement($this->dropDetailsView());
        DB::statement($this->dropNewsletterUsersView());

        //la rimuovo perchè mi serve una VIEW  e non una TABLE
        /* Schema::dropIfExists('newsletter_view'); */
    }

    private function createNewsletterUserView(){
        return "CREATE OR REPLACE VIEW `newsletter_users` AS SELECT 
            u.id AS base_user_id,
            u.name,
            u.email,
            d.gender,
            d.birth_date,
            d.age,
        
            -- //con IFNULL condizioniamo il ritorno se è NULL torniamo 0
            IFNULL(ts.bought, 0) AS bought,
        
            -- // COALESCE prende dalla lista che ha all'interno il più grande numero reale. Possiamo dargli più parametri
            -- //è un altro modo per dirgli di scrivere 0 se torna NULL
            COALESCE(ts.average, 0) AS average,
        
            -- //possiamo usare anche IF per tornare 0 invece di NULL
            -- //se IF è vero metti 0 altrimenti metti ts.spent
            IF (ts.spent IS NULL, 0, ts.spent) AS spent,
        
            -- //per usare age devo crearla come tabella dopo FROM 
            CASE
                WHEN d.gender = 'F' AND d.age > 50 THEN 'layout_1'
                WHEN d.gender = 'F' AND d.age <= 50 THEN 'layout_2'
                WHEN d.gender = 'M' AND d.age < 50 THEN 'layout_3'
                WHEN d.gender = 'M' AND d.age >= 50 THEN 'layout_4'
                ELSE 'layout_0'
            END 
            AS mail_template
        FROM `users` u
            JOIN `details` AS d ON d.user_id = u.id AND d.newsletter = true AND u.email_verified_at IS NOT NULL
            -- //LEFT JOIN perchè se no è INNER JOIN e viene considerato solo chi rispetta tutte le condizioni contemporaneamente
            LEFT JOIN `tickets_stats` ts ON ts.user_id = u.id;
              -- // se JOIN null colonna NULL
              -- //la colonna usata fuori va sempre selezionata dentro la JOIN";
    }

    private function dropNewsletterUsersView(){
        return  <<<SQL
                DROP VIEW IF EXISTS `newsletter_user`;
SQL;
                // Abbiamo usato SQL senta i doppi apici ("")
                //va scritto <<<nomelinguaggio e dentro anche gli spazi sono riconosiuti dalla stringa
                //per questo va chiuso con nomelinguaggio alla prima colonna
    }    

    private function dropDetailsView(){
        return "DROP VIEW IF EXISTS `details`;";
    }    

    private function dropTicketStatsView(){
        return "DROP VIEW IF EXISTS `tickets_stats`;";
    }    

    private function createDetailsView(){
        return <<<SQL
                CREATE OR REPLACE VIEW `details` AS SELECT  
                    ud.user_id,
                    DATE_FORMAT(ud.birth_date, '%d/%m/%Y') AS birth_date,
                    ud.gender, 
                    ud.newsletter,
                    TRUNCATE(DATEDIFF(NOW(), ud.birth_date) /365, 0) AS age
                FROM user_details ud;
SQL;
    }    

    private function createTicketsStatsView(){
        return "CREATE OR REPLACE VIEW `tickets_stats` AS SELECT  
                    user_id,
                    COUNT(t.`id`) AS bought,
                    AVG(s. `price`) AS average,
                    SUM(s.`price`) AS spent
                FROM tickets t
                JOIN shows AS s ON t.show_id = s.id
                GROUP BY user_id;";
    }
}
