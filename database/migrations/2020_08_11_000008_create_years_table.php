
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateYearsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("years", function (Blueprint $table) {

						$table->bigIncrements('id');
						$table->integer('year');
						$table->timestamps();
						$table->softDeletes();



						// ----------------------------------------------------
						// -- SELECT [years]--
						// ----------------------------------------------------
						// $query = DB::table("years")
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
                Schema::dropIfExists("years");
            }
        }
    