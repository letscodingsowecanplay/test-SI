<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJawabanToNilaiTable extends Migration
{
    public function up()
    {
        Schema::table('nilai', function (Blueprint $table) {
            $table->json('jawaban')->nullable()->after('total_soal');
        });
    }

    public function down()
    {
        Schema::table('nilai', function (Blueprint $table) {
            $table->dropColumn('jawaban');
        });
    }
}
