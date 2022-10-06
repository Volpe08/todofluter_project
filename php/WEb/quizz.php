<?php

include ('verification_saisi.php');
$questions=[
    array(
        "name" => "ultime",
        "type" => "text",
        "text" => "Quelle est la réponse ultime",
        "answer" => "42",
        "score" => 1
    ),

    array(
        "name" => "cheval",
        "type" => "radio",
        "text" => "Quelle est la couleur du cheval blanc d'henri IV ?",
        "choices" => [
            array(
                "text" => "Bleu",
                "value" => "bleu"),
            array(
                "text" => "Vert",
                "value" => "vert"),
            array(
                "text" => "Blanc",
                "value" => "blanc")
            ],
        "answer" => "blanc",
        "score" => 2
    ),array(
        "name" => "Langage",
        "type" => "checkbox",
        "text" => "Quels sont les langage du web ?",
        "choices" => [
            array(
                "text" => "HTML",
                "value" => "HTML"),
            array(
                "text" => "C++",
                "value" => "C++"),
            array(
                "text" => "Bash",
                "value" => "Bash"),
            array(
                "text" => "JS",
                "value" => "JS")
        ],
        "answer" => "HTML",
        "answer" => "JS",
        "score" => 2
    ),
    array(
        "name" => "number",
        "type" => "number",
        "text" => "Combien a tu de doigt",
        "answer" => 10,
        "score" => 1
    ),
        ];

$questions_total = 0;
$question_correct = 0;
$score_max = 0;
$score = 0;

/* pour afficher une question de type text */
function question_text($q){
    /** $q = question */
    echo $q['text'] ."<br/><input type='text' name='$q[name]' req><br/>\n";
}

function question_number($q){
    /** $q = question */
    echo $q['text'] ."<br/><input type='number' name='$q[name]' required><br/>\n";
}
/* pour traiter la réponse à une question de type text */
function answer_text($q,$v){
     /** $q = question
      *  $v = valeur réponse attendue 
     */
    global $question_correct,$score_max, $score;
    $score_max += $q['score'];
    if (is_null($v)) return;
    if (verification_saisi($q['answer']) == $v){
        $question_correct += 1;
        $score += $q['score'];
    }
}

/* pour afficher une question de type radio (choix exclusif) */
function question_radio($q){
    /** $q = question */
    $html = $q['text'] . "<br/>\n";
    $i = 0;
    foreach($q['choices'] as $c){
        $i += 1;
        $html .= "<input type='radio' name='$q[name]' value='$c[value]' id='$q[name]-$i'>";
        $html .= "<label for='$q[name]-$i'>$c[text]</label>\n";
    }
    echo $html;
}

function question_checkbox($q){
    /** $q = question */
    $html = $q['text'] . "<br/>\n";
    $i = 0;
    foreach($q['choices'] as $c){
        $i += 1;
        $html .= "<input type='checkbox' name='$q[name]' value='$c[value]' id='$q[name]-$i'>";
        $html .= "<label for='$q[name]-$i'>$c[text]</label>\n";
    }
    echo $html;
}

$question_handlers = array(
    "text" => "question_text",
    "radio" => "question_radio",
    "checkbox" => "question_checkbox",
    "number" => "question_number",

);
$answer_handlers = array(
    "text" => "answer_text",
    "radio" => "answer_text",
    "checkbox" => "answer_text",
    "number" => "answer_text",

);

if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    // On présente les questions
    echo "<form method='POST' action='quizz.php'>\n<ol>\n";

    echo "<fieldset for = 'quest1'>
                <br />
                <legend>Identification</legend>
                <p>
                <label > Nom : </label>
                <input type='text' name='nom' id='nom' value='' readonly></p>
                <p>
                    <label > Prénom : </label>
                    <input type='text' name='prenom' id='prenom' value='' readonly></p>
                <p >
                    <label > Score : </label>
                    <input disabled type='text' name='total' id='total' value=''></p>
            </fieldset>";

    echo "<fieldset>
    <legend>Quizzz</legend><br/><br/>\n";
    foreach ($questions as $q){
        echo "<li>";
        $question_handlers[$q['type']]($q);
    }
    echo "<input type='submit' value='Repondre'>\n</ol>\n</fieldset>\n</form>\n";
}
else{ // Méthode POST
    // On répond au client et on calcule son score
    $questions_total = 0;
    $questions_total = 0;
    $question_correct = 0;
    $score_max = 0;
    $score = 0;
    foreach ($questions as $q){
        $questions_total += 1;
        $answer_handlers[$q['type']]($q, verification_saisi($_POST[$q['name']]) ?? NULL);
    }



    echo "<form><fieldset for='quest1'>
                <br />
                <legend>Identification</legend>
                <p >
                    <label > Score : </label>
                    <input disabled type='text' name='total' id='total' value='$score / $score_max'></p>
                    <p><label > Réponse correctes : </label>
                    <input disabled type='text' name='total_question' id='total_question' value='$question_correct / $questions_total'></p><br>
            </fieldset></form>";
}

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quizz</title>
    <link rel="stylesheet" href="form.css">

</head>
<body>

</body>
<script src="tools.js"></script>

</html>





