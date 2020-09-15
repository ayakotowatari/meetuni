
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateCountriesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("countries", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->string('country',191);
                        $table->bigInteger('region_id')->unsigned();
                        $table->integer('destination');
						$table->timestamps();
                        $table->softDeletes();
                        
						$table->foreign("region_id")->references("id")->on("regions");



						// ----------------------------------------------------
						// -- SELECT [countries]--
						// ----------------------------------------------------
						// $query = DB::table("countries")
						// ->leftJoin("regions","regions.id", "=", "countries.region_id")
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
                Schema::dropIfExists("countries");
            }
        }
    