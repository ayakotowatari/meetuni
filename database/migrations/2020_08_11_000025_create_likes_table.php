
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateLikesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("likes", function (Blueprint $table) {

                        $table->unsignedInteger('student_id');
                        $table->unsignedInteger('event_id');
                        $table->integer('notifications')->nullable();
                        $table->timestamps();
                        $table->softDeletes();
                        
                        $table->index('student_id');
                        $table->index('event_id');
            
                        $table->unique([
                            'student_id',
                            'event_id'
                        ]);



						// ----------------------------------------------------
						// -- SELECT [event_user]--
						// ----------------------------------------------------
						// $query = DB::table("event_user")
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
                Schema::dropIfExists("event_student");
            }
        }
    