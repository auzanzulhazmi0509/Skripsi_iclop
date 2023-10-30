<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Question;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;

class ValidatorController extends Controller
{
    private $isAllowSubmit = false;

    public function connect(){
        if (!pg_connect("host=localhost port=5432 dbname=iclop user=postgres password=auzanzulhazmi")) {
            throw new \Exception('SYSTEM_ERROR: Cant connect to database!');
        }else{
            return pg_connect("host=localhost port=5432 dbname=iclop user=postgres password=auzanzulhazmi");
        }

    }

    public function execute_test($question_id, $connection, $code){

	$test = Question::where('id', '=', $question_id)->get();
        $this->answer = $test[0]->answer;
        $this->hint = $test[0]->hint;
        $this->user_id = Auth::user()->id;

        $query = "CREATE OR REPLACE FUNCTION public.test_" . $this->user_id ."()" . "\r\n";
        $query .= "RETURNS SETOF TEXT LANGUAGE plpgsql AS $$ \r\n";
        $query .= "BEGIN \r\n";
        $query .= "RETURN NEXT \r\n";
        $query .= "results_eq( \r\n";
        $query .=  "'" . $code . "', \r\n";
        $query .= "'" . $this->answer . "', \r\n";
        $query .= "'" . $this->hint . "' \r\n";
        $query .= "); \r\n";
        $query .= "END; \r\n";
        $query .= "$$; \r\n";
        $query .= "SELECT * FROM runtests('public'," . "'test_" . $this->user_id . "'" . ") offset 1 limit 1;";

	    $result = pg_query($connection, $query);
        if (!$result) {
           throw new \Exception($this->displayError(pg_last_error($connection)));
        } else {
            return $result;
        }
    }

    public function disconnect_from_database($connection)
    {
        pg_close($connection);
    }

    public function get_test_result($result){
        while ($row = pg_fetch_assoc($result)) {
            $test_result = $row['runtests'];
        }
        return $test_result;
    }

    public function display_test_result($testResult)
    {
        $result = "<div id='output-text' class='w-100 font-weight-bold'> ";
	while ($row = pg_fetch_assoc($testResult)) {
            if (strpos($row['runtests'], 'not ok') !== false) {
                $this->isAllowSubmit = false;
                $result .= "<div class='alert alert-warning'>";
                $result .= "<i class='fas fa-exclamation-triangle''></i> " . "Jawaban yang anda masukkan kurang tepat. Harap Periksa Kembali Jawaban Anda";
                $result .= "<p> </p>";
                $result .= "<i class='fas fa-exclamation-triangle'></i> " . $row['runtests'];
                $result .= "</div>";
            } else if (strpos($row['runtests'], 'failed: ') !== false) {
                $this->isAllowSubmit = false;
                $result .= "<div class='alert alert-danger'>";
                $result .= "<i class='fas fa-exclamation-triangle'></i> " . "Jawaban yang anda masukkan SALAH, Harap Periksa Lagi" ;
                $result .= "<p> </p>";
                $result .= "<i class='fas fa-exclamation-triangle'></i> " . $row['runtests'];
                $result .= "</div>";
            } else if (strpos($row['runtests'], 'Error') !== false) {
                $this->isAllowSubmit = false;
                $result .= "<div class='alert alert-danger'>";
                // $result .= "<i class='fas fa-exclamation-triangle'></i> " . $row['runtests'];
                $result .= "<i class='fas fa-times'></i> " . "Jawaban yang anda masukkan SALAH, Harap Periksa Lagi" ;
                $result .= "<p> </p>";
                $result .= "<i class='fas fa-times'></i> " . $row['runtests'];
                $result .= "</div>";
            }
            else {
                $this->isAllowSubmit = true;
                $result .= "<div class='alert alert-success'>";
                $result .= "<i class='fas fa-check'> </i> " . $row['runtests'];
                $result .= "</div>";
	}
    }
	$result .= "</div>";
        return $result;
    }

    public function execute_code(Request $request){
        $connection = $this->connect();
        $stat = pg_connection_status($connection);

        if ($stat === PGSQL_CONNECTION_OK) {
            $stat =  'Connection status ok';
        } else {
            $stat = 'Connection status bad';
        }

        $result = $this->execute_test($request->question_id, $connection, $request->code);
        $test_result = $this->display_test_result($result);
        $this->disconnect_from_database($connection);
        return response()->json(['result' => $test_result]);


    }

    public function submit(Request $request){
        # Execute code
        $connection = $this->connect();
        $result = $this->execute_test($request->question_id, $connection, $request->code);
        $test_result = $this->display_test_result($result);
        $this->disconnect_from_database($connection);

        # Save submmsion detail
        if ($this->isAllowSubmit == true) {
            $result = Submission::updateOrCreate(
                ['student_id' => $request->user_id, 'question_id' => $request->question_id],
                ['status' => 'Passed', 'answer' => $request->code]
            );
            if (!$result) {
                return response()->json([
                    'result' => $test_result,
                    'status' => 'passed',
                    'message' => 'GAGAL menyimpan jawaban!',
                ]);
            } else {
                return response()->json([
                    'result' => $test_result,
                    'status' => 'passed',
                    'message' => 'BERHASIL menyimpan jawaban!',
                ]);
            }
        } else {
            $result = Submission::updateOrCreate(
                ['student_id' => $request->user_id, 'question_id' => $request->question_id],
                ['status' => 'Failed', 'answer' => $request->code]
            );
            if (!$result) {
                return response()->json([
                    'result' => $test_result,
                    'status' => 'failed',
                    'message' => 'GAGAL menyimpan jawaban!',
                ]);
            } else {
                return response()->json([
                    'result' => $test_result,
                    'status' => 'failed',
                    'message' => 'Masih terdapat kesalahan! Silahkan perbaiki terlebih dahulu jawaban Anda!',
                ]);
            }
        }
    }

}
