<?php include('session.php'); ?>
<html>

<head>
    <?php include('head.php'); ?>
    <title>Editor only for admin</title>
    <style>
        form {
            width: 960px;
        }
        #playagain {
            display: none;
        }
    </style>
</head>

<body>
    <?php include('nav.php'); ?>
    <div class="container">
        <div class="d-flex justify-content-center">
            <h1 class="text-center">Quiz:</h1>
        </div>
        <div class="d-flex justify-content-center">
            <form method="POST">
                <?php
                $sql = "SELECT * FROM questions ORDER BY RAND() LIMIT 10";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    $a = array(); //array for correct answers
                    $i = 1; //counter for questions
                    while ($row = $result->fetch_assoc()) {
                        //+1 to all_answers
                        $total = $row['all_answers'] + 1;
                        $sql2 = "UPDATE questions SET `all_answers`=$total WHERE id='" . $row['id'] . "'";
                        $conn->query($sql2);

                        //correct answers push correct answer
                        array_push($a, $row);
                        echo
                            '
                    <ul class="list-group mb-3" id="ul' . $i . '">
            <li class="list-group-item active"><h3>' . $i . '. ' . $row["question"] . '</h3></li>
            <li class="list-group-item">
                <div class="form-check">
                    <label class="form-check-label">
                        <input checked required value="a" type="radio" class="form-check-input" name="q' . $i . '">' . $row["a"] . '
                    </label>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-check">
                    <label class="form-check-label">
                        <input value="b" type="radio" class="form-check-input" name="q' . $i . '">' . $row["b"] . '
                    </label>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-check">
                    <label class="form-check-label">
                        <input value="c" type="radio" class="form-check-input" name="q' . $i . '">' . $row["c"] . '
                    </label>
                </div>
            </li>
            <li class="list-group-item">
                <div class="form-check">
                    <label  class="form-check-label">
                        <input value="d" type="radio" class="form-check-input" name="q' . $i . '">' . $row["d"] . '
                    </label>
                </div>
            </li>
        </ul>
                    ';
                        $i++;
                    }
                } else {
                    echo "NO QUESTIONS IN DATABASE";
                }
                ?>
            </form>
        </div>
        <h1 id="score" class="text-center"></h1>
        <div class="mb-3 col d-flex justify-content-center">
            <button id="checkquiz" class="btn btn-primary">Send Quiz</button>
            <button id="playagain" class="btn btn-warning">Play again</button>
        </div>
    </div>

    <?php include('scripts.php'); ?>

    <script>
        letterToNumber = (letter) => {
            switch (letter) {
                case 'a':
                    return 0;
                    break;
                case 'b':
                    return 1;
                    break;
                case 'c':
                    return 2;
                    break;
                case 'd':
                    return 3;
                    break;
                default:
                    return 0;
            }
        }

        $(document).ready(function() {
            var body = $("html, body");
            body.stop().animate({
                scrollTop: 0
            }, 500, 'swing', function() {
            });
        })

        $("#checkquiz").click(() => {


            $("#checkquiz").hide();
            $("#playagain").show();

            var all = <?php echo json_encode($a); ?>;
            var answers = [];
            $.each($("input:checked"), function(index) {
                answers.push($(this).val());
                var nowCorrect = all[index].correct;
                var x = letterToNumber(nowCorrect);
                if ($(this).val() == nowCorrect) {
                    $(this).parents()[2].classList.add("bg-success")
                } else {
                    $(this).parents()[2].classList.add("bg-danger")
                    $a = $(this).parent().parent().parent().siblings(".list-group-item")[letterToNumber(nowCorrect)].classList.add("bg-success")
                }

            });

            $.ajax({
                type: 'POST',
                url: "./actions/quizAction.php",
                data: {
                    array: <?php echo json_encode($a); ?>,
                    answers: answers,
                    user: "<?php echo $user_check; ?>",
                    action: 'quiz'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    score = "your score:" + data.pts / 10 * 100 + "%"
                    $("#score").text(score)
                }
            })
            <?php $conn->close(); ?>
        });
        $("#playagain").click(() => {
            location.reload();
        })
    </script>
</body>

</html>