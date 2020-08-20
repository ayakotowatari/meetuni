
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateEventRegionTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("event_region", function (Blueprint $table) {

                        $table->unsignedInteger('event_id');
                        $table->unsignedInteger('region_id');
						$table->timestamps();
						$table->softDeletes();

                        $table->index('event_id');
                        $table->index('region_id');
            
                        $table->unique([
                            'event_id',
                            'region_id'
                        ]);

						// ----------------------------------------------------
						// -- SELECT [event_region]--
						// ----------------------------------------------------
						// $query = DB::table("event_region")
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
                Schema::dropIfExists("event_region");
            }
        }
    