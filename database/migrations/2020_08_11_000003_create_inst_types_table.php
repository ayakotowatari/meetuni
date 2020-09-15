
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateInstTypesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("inst_types", function (Blueprint $table) {

						$table->bigIncrements('id');
						$table->string('inst_type',191)->nullable();
						$table->timestamps();
						$table->softDeletes();



						// ----------------------------------------------------
						// -- SELECT [inst_types]--
						// ----------------------------------------------------
						// $query = DB::table("inst_types")
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
                Schema::dropIfExists("inst_types");
            }
        }
    