<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        .nav-link {
            color: #ffbb33;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="container w-50 text-center">
        <p class="mb-5 fs-1">Students marks</p>
        <div class="card mt-3 mb-3">
            <div class="card-body">
                <p class="text-center mb-5"> Let's get students data from your file:</p>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3 mt-3 row">
                        <div class="col-sm-8">
                            <input type="hidden" name="upload" value="1">
                            <input type="file" name="file">
                        </div>
                    </div>
                    <div class="row align-items-center mt-3">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-warning btn-md">Let's check!</button>
                        </div>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <?php

                    if (isset($_POST['upload'])) {

                        move_uploaded_file($_FILES['file']['tmp_name'], 'C:/xampp/htdocs/PHP/Homework/Friday_challenge/Students_grades/' . $_FILES['file']['name']);

                        $file = 'C:/xampp/htdocs/PHP/Homework/Friday_challenge/Students_grades/' . $_FILES['file']['name'];
                        $f = fopen($file, "r");

                        $student = [];
                        $sumAverage = [];
                        $newArray = [];
                        $gradeCountArray = [];
                        $count = 0;

                        while ($row = fgets($f)) {
                            $student = explode(",", $row);
                            $name = array_shift($student);
                            $count++;

                            foreach ($student as $id => $grade) {
                                $average = '';

                                $average = round(array_sum($student) / count($student), 1);

                                array_push($sumAverage, $average);

                                $newArray[$name] = $average;
                            }

                            echo "<b>$name</b> average of the grades is: <b>$average</b>. <br>";

                        }

                        echo "<hr>";

                        $averageGroup = round(array_sum($sumAverage) / count($sumAverage), 1);

                        echo "Average of the whole group is: <b>$averageGroup</b>. <hr>";

                        echo "There are <b>$count</b> students in this class. <hr>";

                        print_r($newArray);

                        echo "<hr>";

                        fclose($f);

                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>