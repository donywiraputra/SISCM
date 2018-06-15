<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Scmdb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('users', function (Blueprint $table){
           $table->increments('id');
           $table->unsignedInteger('roles_id')->nullable();
           $table->string('namauser')->unique;
           $table->string('namalengkap');
           $table->string('password');
           $table->rememberToken();
           $table->timestamps();
         });

         Schema::create('roles', function (Blueprint $table){
           $table->increments('id');
           $table->string('namarole');
         });

         Schema::create('jeniskelamin', function (Blueprint $table){
           $table->increments('idkelamin');
           $table->string('kelamin');
         });

         Schema::create('katagorimember', function (Blueprint $table){
           $table->increments('idkatmember');
           $table->string('katmember');
         });

         Schema::create('jenistransaksi', function (Blueprint $table){
           $table->increments('idjnstransaksi');
           $table->string('namatransaksi');
           $table->integer('biaya');
           $table->integer('bulan');
         });

         Schema::create('member', function (Blueprint $table){
           $table->increments('idmember');
           $table->unsignedInteger('id_katmember')->nullable();
           $table->string('namamember');
           $table->string('namalengkap');
           $table->unsignedInteger('jnskelamin')->nullable();
           $table->string('alamat');
           $table->date('tgl_lahir');
           $table->date('expired_date');
           $table->string('notelp');
           $table->timestamps();
           $table->softDeletes();
         });

         Schema::create('datatransaksi', function (Blueprint $table){
           $table->increments('idtransaksi');
           $table->unsignedInteger('idjenistransaksi')->nullable();
           $table->unsignedInteger('id_member')->nullable();
           $table->unsignedInteger('iduser')->nullable();
           $table->timestamps();
           $table->softDeletes();
         });

         Schema::create('jenisbarang', function (Blueprint $table){
           $table->increments('id');
           $table->string('namabarang');
           $table->integer('harga');
           $table->integer('stok');
           $table->unsignedInteger('iduser')->nullable();
           $table->timestamps();
           $table->softDeletes();
         });

         Schema::create('transaksidagang', function (Blueprint $table){
           $table->increments('id');
           $table->unsignedInteger('idbarang')->nullable();
           $table->integer('jumlah');
           $table->integer('biaya');
           $table->unsignedInteger('iduser')->nullable();
           $table->timestamps();
           $table->softDeletes();
         });

         Schema::create('pengeluaran', function (Blueprint $table){
           $table->increments('id');
           $table->string('keterangan');
           $table->integer('jumlah');
           $table->unsignedInteger('iduser')->nullable();
           $table->timestamps();
           $table->softDeletes();
         });

         Schema::table('users', function (Blueprint $table){
           $table->foreign('roles_id')
                 ->references('id')
                 ->on('roles')
                 ->onDelete('cascade')->onUpdate('cascade');
         });

         Schema::table('member', function (Blueprint $table){
           $table->foreign('id_katmember')
                 ->references('idkatmember')
                 ->on('katagorimember')
                 ->onDelete('cascade')->onUpdate('cascade');
           $table->foreign('jnskelamin')
                 ->references('idkelamin')
                 ->on('jeniskelamin')
                 ->onDelete('cascade')->onUpdate('cascade');
         });

         Schema::table('datatransaksi', function (Blueprint $table){
           $table->foreign('idjenistransaksi')
                 ->references('idjnstransaksi')
                 ->on('jenistransaksi')
                 ->onDelete('cascade')->onUpdate('cascade');
           $table->foreign('id_member')
                 ->references('idmember')
                 ->on('member')
                 ->onDelete('cascade')->onUpdate('cascade');
           $table->foreign('iduser')
                 ->references('id')
                 ->on('users')
                 ->onDelete('cascade')->onUpdate('cascade');
         });

         Schema::table('jenisbarang', function (Blueprint $table){
           $table->foreign('iduser')
                 ->references('id')
                 ->on('users')
                 ->onDelete('cascade')->onUpdate('cascade');
         });

         Schema::table('transaksidagang', function (Blueprint $table){
           $table->foreign('idbarang')
                 ->references('id')
                 ->on('jenisbarang')
                 ->onDelete('cascade')->onUpdate('cascade');
           $table->foreign('iduser')
                 ->references('id')
                 ->on('users')
                 ->onDelete('cascade')->onUpdate('cascade');
         });

         Schema::table('pengeluaran', function (Blueprint $table){
           $table->foreign('iduser')
                 ->references('id')
                 ->on('users')
                 ->onDelete('cascade')->onUpdate('cascade');
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::drop('users');
         Schema::drop('roles');
         Schema::drop('jeniskelamin');
         Schema::drop('katagorimember');
         Schema::drop('jenistransaksi');
         Schema::drop('member');
         Schema::drop('datatransaksi');
         Schema::drop('jenisbarang');
         Schema::drop('transaksidagang');
         Schema::drop('pengeluaran');
     }
 }
