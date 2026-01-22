<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classificacao_credito_presumido', function (Blueprint $table) {
    $table->id();

    // FK curta (evita erro 1059)
    $table->unsignedBigInteger('classificacao_tributaria_id');

    $table->foreign(
        'classificacao_tributaria_id',
        'fk_classif_credpres_classif'
    )->references('id')
     ->on('classificacoes_tributarias')
     ->cascadeOnDelete();

    $table->string('codigo', 20);
    $table->string('descricao', 255)->nullable();

    $table->enum('tributo', ['icms', 'pis', 'cofins', 'ibs', 'cbs']);

    $table->decimal('percentual', 10, 4)->nullable();
    $table->enum(
        'base_calculo',
        ['valor_operacao', 'icms', 'pis', 'cofins', 'ibs', 'cbs']
    )->nullable();

    $table->enum('apropriacao', ['nfe', 'evento'])->default('nfe');
    $table->string('base_legal', 255)->nullable();

    $table->boolean('ativo')->default(true);
    $table->timestamps();

    $table->unique(
        ['classificacao_tributaria_id', 'codigo', 'tributo'],
        'uniq_classif_credpres'
    );
});

    }

    public function down(): void
    {
        Schema::dropIfExists('classificacao_credito_presumido');
    }
};
