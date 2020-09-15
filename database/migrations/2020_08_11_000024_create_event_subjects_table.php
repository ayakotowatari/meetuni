
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateEventSubjectsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("event_subjects", function (Blueprint $table) {

                        $table->unsignedInteger('event_id');
                        $table->unsignedInteger('subject_id');
						$table->timestamps();
						$table->softDeletes();

                        $table->index('event_id');
                        $table->index('subject_id');
            
                        $table->unique([
                            'event_id',
                            'subject_id'
                        ]);

						// ----------------------------------------------------
						// -- SELECT [event_subject]--
						// ----------------------------------------------------
						// $query = DB::table("event_subject")
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
                Schema::dropIfExists("event_subject");
            }
        }
    