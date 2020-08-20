
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateInstUsersTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("inst_users", function (Blueprint $table) {

						$table->bigInteger('id')->unsigned();
						$table->bigInteger('inst_id')->unsigned();
						$table->string('job_title',191);
						$table->string('department',191);
						$table->timestamps();
                        $table->softDeletes();
                        
						$table->foreign("id")->references("id")->on("users");
                        $table->foreign("inst_id")->references("id")->on("insts");


						// ----------------------------------------------------
						// -- SELECT [inst_users]--
						// ----------------------------------------------------
						// $query = DB::table("inst_users")
						// ->leftJoin("users","users.id", "=", "inst_users.id")
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
                Schema::dropIfExists("inst_users");
            }
        }
    