
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateQueriesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("queries", function (Blueprint $table) {
						  
                        $table->bigIncrements('id')->unsigned();
                        $table->bigInteger('event_id')->unsigned();
                        $table->bigInteger('category_id')->unsigned();
                        $table->bigInteger('student_id')->unsigned();
                        $table->string('contents',191);
                        $table->timestamps();
                        $table->softDeletes();
                        
                        $table->foreign("event_id")->references("id")->on("events");
                        $table->foreign("category_id")->references("id")->on("categories");
                        $table->foreign("student_id")->references("id")->on("students");


						// ----------------------------------------------------
						// -- SELECT [queries]--
						// ----------------------------------------------------
						// $query = DB::table("queries")
						// ->leftJoin("events","events.id", "=", "queries.event_id")
						// ->leftJoin("categories","categories.id", "=", "queries.category_id")
						// ->leftJoin("students","students.id", "=", "queries.student_id")
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
                Schema::dropIfExists("queries");
            }
        }
    