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
        Schema::table('perwalian', function (Blueprint $table) {
            $table->string('nip',40)->required()->after('id_matakuliah');
            $table->foreign('nip')->references('nip')->on('dosen')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perwalian', function (Blueprint $table) {
            $table->dropForeign(['nip']);
            $table->dropColumn('nip');
        });
    }
};
