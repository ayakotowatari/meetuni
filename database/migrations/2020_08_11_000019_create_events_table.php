
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateEventsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("events", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->string('title',191);
						$table->bigInteger('inst_id')->unsigned();
						$table->string('date');
						$table->string('timezone', 191);
						$table->string('start_time');
						$table->string('end_time');
						$table->string('start_utc');
						$table->string('end_utc');
						$table->text('description',600)->nullable();
						$table->string('image',191)->nullable();
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
						// -- SELECT [events]--
						// ----------------------------------------------------
						// $query = DB::table("events")
						// ->leftJoin("insts","insts.id", "=", "events.inst_id")
						// ->leftJoin("capacities","capacities.id", "=", "events.capacity_id")
						// ->leftJoin("statuses","statuses.id", "=", "events.status_id")
						// ->leftJoin("inst_users","inst_users.id", "=", "events.inst_user_id")
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
                Schema::dropIfExists("events");
            }
        }
    