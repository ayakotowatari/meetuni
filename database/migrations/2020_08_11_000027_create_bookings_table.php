
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateBookingsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("bookings", function (Blueprint $table) {

                        $table->bigIncrements('id')->unsigned();
                        $table->bigInteger('event_id')->unsigned();
                        $table->bigInteger('student_id')->unsigned();
                        $table->string('first_name', 191);
                        $table->string('last_name', 191);
                        $table->string('email', 191);
                        $table->integer('cancelled');
                        $table->timestamps();
                        $table->softDeletes();
                        
                        $table->foreign("event_id")->references("id")->on("events");
                        $table->foreign("student_id")->references("id")->on("students");



						// ----------------------------------------------------
						// -- SELECT [bookings]--
						// ----------------------------------------------------
						// $query = DB::table("bookings")
						// ->leftJoin("events","events.id", "=", "bookings.event_id")
						// ->leftJoin("students","students.id", "=", "bookings.student_id")
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
                Schema::dropIfExists("bookings");
            }
        }
    