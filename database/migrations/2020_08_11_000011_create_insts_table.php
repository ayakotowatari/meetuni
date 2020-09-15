
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateInstsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("insts", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->string('name',191);
						$table->bigInteger('inst_type_id')->unsigned();
						$table->bigInteger('country_id')->unsigned();
						$table->string('email_check',191);
						$table->integer('life');
						$table->timestamps();
                        $table->softDeletes();
                        $table->unique('name');
                        
						$table->foreign("inst_type_id")->references("id")->on("inst_types");
						$table->foreign("country_id")->references("id")->on("countries");



						// ----------------------------------------------------
						// -- SELECT [insts]--
						// ----------------------------------------------------
						// $query = DB::table("insts")
						// ->leftJoin("inst_types","inst_types.id", "=", "insts.inst_type_id")
						// ->leftJoin("countries","countries.id", "=", "insts.country_id")
						// ->get();
						// dd($query); //For checking



                });
            }

            /**
             * Reverse the migrations.
             *
             * @return void
             */
            public function down()
            {
                Schema::dropIfExists("insts");
            }
        }
    