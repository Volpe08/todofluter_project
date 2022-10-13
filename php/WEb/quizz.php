<?php

include('verification_saisi.php');
$questions = [
    array(
        "name" => "ultime",
        "type" => "text",
        "text" => "Quelle est la réponse ultime",
        "answer" => "42",
        "score" => 1
    ), array(
        "name" => "url",
        "type" => "url",
        "text" => "Quel est l'url de google",
        "answer" => "www.google.fr",
        "score" => 1
    ), array(
        "name" => "tel",
        "type" => "tel",
        "text" => "Numéro du samu",
        "answer" => "15",
        "score" => 1
    ), array(
        "name" => "datequizz",
        "type" => "date",
        "text" => "Quel jour doit être rendu ce quizz ?",
        "answer" => "2022-10-07",
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
    ), array(
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
    ), array(
        "name" => "select",
        "type" => "select",
        "text" => "En quel année la production de voiture thermique s'arrête ?",
        "choices" => [
            array(
                "text" => "2025",
                "value" => "2025"),
            array(
                "text" => "2030",
                "value" => "2030"),
            array(
                "text" => "2035",
                "value" => "2035"),
            array(
                "text" => "2040",
                "value" => "2040")
        ],
        "answer" => "2035",
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
function question_text($q)
{
    /** $q = question */
    echo $q['text'] . "<br/><input type='text' name='$q[name]' minlength='2' required><br/>\n";
}

function question_url($q)
{
    /** $q = question */
    echo $q['text'] . "<br/><input type='url' name='$q[name]' onkeydown='Url_Valide(this.value, `$q[name]`)' required><br/><strong><div id='$q[name]'></div></strong><br>\n";
}

function question_tel($q)
{
    /** $q = question */
    echo $q['text'] . "<br/><input type='tel' name='$q[name]' id='$q[name]' required><br/>\n";
}

function question_date($q)
{
    /** $q = question */
    echo $q['text'] . "<br/><input type='date' name='$q[name]' id='$q[name]' required ><br/>\n";
}

function question_select($q)
{
    /** $q = question */
    $i = 0;
    $html = $q['text'] . "<br/>";
    foreach ($q['choices'] as $c) {

        $i += 1;
        $html .= "<option value='$c[value]'>$c[value]</option>";

    }
    $select = "<br><br><select class='box' name='$q[name]'>" . $html . "</select><br><br>";
    echo $q['text'] . $select;
}

function question_number($q)
{
    /** $q = question */
    echo $q['text'] . "<br/><input type='number' name='$q[name]' onkeyup='verif_number(this.value, `$q[name]`);' required><br/><strong><div id='$q[name]'></div></strong>\n";
}

/* pour traiter la réponse à une question de type text */
function answer_text($q, $v)
{
    /** $q = question
     *  $v = valeur réponse attendue
     */
    global $question_correct, $score_max, $score;
    $score_max += $q['score'];
    if (is_null($v)) return;
    if (verification_saisi($q['answer']) == $v) {
        $question_correct += 1;
        $score += $q['score'];
    }
}

function answer_date($q, $v)
{
    /** $q = question
     *  $v = valeur réponse attendue
     */
    global $question_correct, $score_max, $score;
    $score_max += $q['score'];
    if (is_null($v)) return;
    if ($q['answer'] == $v) {
        $question_correct += 1;
        $score += $q['score'];
    }
}

/* pour afficher une question de type radio (choix exclusif) */
function question_radio($q)
{
    /** $q = question */
    $html = $q['text'] . "<br/>\n";
    $i = 0;
    foreach ($q['choices'] as $c) {
        $i += 1;
        if ($i == 1) {
            $html .= "<input type='radio' name='$q[name]' value='$c[value]' id='$q[name]-$i' checked>";
            $html .= "<label for='$q[name]-$i'>$c[text]</label>\n";
        } else {
            $html .= "<input type='radio' name='$q[name]' value='$c[value]' id='$q[name]-$i'>";
            $html .= "<label for='$q[name]-$i'>$c[text]</label>\n";
        }
    }
    echo $html;
}

function question_checkbox($q)
{
    /** $q = question */
    $html = $q['text'] . "<br/>\n";
    $i = 0;
    foreach ($q['choices'] as $c) {
        $i += 1;
        if ($i == 1) {
            $html .= "<input type='checkbox' name='$q[name]' value='$c[value]' id='$q[name]-$i' checked>";
            $html .= "<label for='$q[name]-$i'>$c[text]</label>\n";
        } else {
            $html .= "<input type='checkbox' name='$q[name]' value='$c[value]' id='$q[name]-$i'>";
            $html .= "<label for='$q[name]-$i'>$c[text]</label>\n";
        }
    }
    echo $html;
}

$question_handlers = array(
    "text" => "question_text",
    "url" => "question_url",
    "radio" => "question_radio",
    "checkbox" => "question_checkbox",
    "number" => "question_number",
    "select" => "question_select",
    "tel" => "question_tel",
    "date" => "question_date",

);
$answer_handlers = array(
    "text" => "answer_text",
    "url" => "answer_text",
    "radio" => "answer_text",
    "checkbox" => "answer_text",
    "number" => "answer_text",
    "select" => "answer_text",
    "tel" => "answer_text",
    "date" => "answer_date",

);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
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
    foreach ($questions as $q) {
        echo "<li>";
        $question_handlers[$q['type']]($q);
    }
    echo "<input type='submit' id='valide' value='Repondre'>\n</ol>\n</fieldset>\n</form>\n";
} else { // Méthode POST
    // On répond au client et on calcule son score
    $questions_total = 0;
    $questions_total = 0;
    $question_correct = 0;
    $score_max = 0;
    $score = 0;
    foreach ($questions as $q) {
        $questions_total += 1;
        $answer_handlers[$q['type']]($q, verification_saisi($_POST[$q['name']]) ?? NULL);
    }
    for ($i=0; $i<10; $i++){

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
<script src="verif_saisi.js"></script>

</html>





