
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateRegionsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("regions", function (Blueprint $table) {

						$table->bigIncrements('id');
						$table->string('region',191);
						$table->timestamps();
						$table->softDeletes();



						// ----------------------------------------------------
						// -- SELECT [regions]--
						// ----------------------------------------------------
						// $query = DB::table("regions")
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
                Schema::dropIfExists("regions");
            }
        }
    