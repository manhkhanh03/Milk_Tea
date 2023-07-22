<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER tr_status_shipping_Default BEFORE UPDATE ON `shipping_tracking` FOR EACH ROW
            BEGIN
                DECLARE old_delivery_person_id INT;
                SET old_delivery_person_id = OLD.delivery_person_id;
                IF NEW.delivery_person_id IS NOT NULL THEN
                    IF NEW.delivery_person_id <> old_delivery_person_id THEN
                        SET NEW.status = "In delivery";
                    ELSE
                        SET NEW.status = NEW.status;
                    END IF;
                END IF;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trigger');
    }
};
