
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateEventLevelTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("event_level", function (Blueprint $table) {

                        $table->unsignedInteger('event_id');
                        $table->unsignedInteger('level_id');
						$table->timestamps();
						$table->softDeletes();

                        $table->index('event_id');
                        $table->index('level_id');
            
                        $table->unique([
                            'event_id',
                            'level_id'
                        ]);

						// ----------------------------------------------------
						// -- SELECT [event_level]--
						// ----------------------------------------------------
						// $query = DB::table("event_level")
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
                Schema::dropIfExists("event_level");
            }
        }
    