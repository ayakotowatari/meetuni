
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateCoursesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("courses", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->string('name',191);
						$table->bigInteger('inst_id')->unsigned();
						$table->string('start_date');
						$table->string('end_date');
						$table->text('description',600);
						$table->string('deadline');
						$table->string('link',191);
						$table->string('image',191);
						$table->bigInteger('capacity_id')->unsigned();
						$table->bigInteger('status_id')->unsigned();
						$table->bigInteger('user_id')->unsigned();
						$table->timestamps();
						$table->softDeletes();

						$table->foreign("inst_id")->references("id")->on("insts");
						$table->foreign("capacity_id")->references("id")->on("capacities");
						$table->foreign("status_id")->references("id")->on("statuses");
						$table->foreign("user_id")->references("id")->on("users");



						// ----------------------------------------------------
						// -- SELECT [courses]--
						// ----------------------------------------------------
						// $query = DB::table("courses")
						// ->leftJoin("insts","insts.id", "=", "courses.inst_id")
						// ->leftJoin("capacities","capacities.id", "=", "courses.capacity_id")
						// ->leftJoin("statuses","statuses.id", "=", "courses.status_id")
						// ->leftJoin("inst_users","inst_users.id", "=", "courses.inst_user_id")
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
                Schema::dropIfExists("courses");
            }
        }
    