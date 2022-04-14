<pre>
<?php

// print_r($_GET);

// si le fomrulaire contenat un champ email, text et number
/*$arr = [
  'email' => 'jean(a)@<gmail>.com',
  'text' => "<script>const 'a' = 1</script>",
  'number' => 'aa12aa'
];
print_r(filter_var_array($arr, [
  'email' => FILTER_SANITIZE_EMAIL,
  'text' => [
    'filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    'flags' => FILTER_FLAG_NO_ENCODE_QUOTES
  ],
  'number' => FILTER_SANITIZE_NUMBER_INT
]));*/
?>
</pre>
<form action="index.php" method="">
  <div>
    <label for="name">Nom</label>
    <input type="text" name="name" id="name">
  </div>
  <button type="submit">Submit</button>
</form>

<!-- exemple de filter_input_array()

<?php
/*$_POST = filter_input_array(INPUT_POST, [
  'firstname' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
  'email' => FILTER_SANITIZE_EMAIL,
  'date' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
  'genre' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
  'cgu' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
  'favoris' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
]);
?>

<form action="" method="POST">
  <div>
    <label for="firstname">Prénom</label><br>
    <input type="text" name="firstname" id="firstname">
  </div>
  <div>
    <label for="email">Email</label><br>
    <input type="email" name="email" id="email">
  </div>
  <div>
    <label for="date">Date</label><br>
    <input type="date" name="date" id="date">
  </div>
  <div>
    <label for="cgu">CGU</label>
    <input type="checkbox" name="cgu" id="cgu">
  </div>
  <div>
    <label for="masculin">Homme</label>
    <input type="radio" name="genre" id="masculin" value="masculin">
    <label for="feminin">Femme</label>
    <input type="radio" name="genre" id="feminin" value="feminin">
  </div>
  <div>
    <label for="favoris">Favoris</label>
    <select name="favoris" id="favoris">
      <option value="wifi">Wifi</option>
      <option value="tv">TV</option>
      <option value="fibre">Fibre</option>
    </select>
  </div>

  <button type="submit">Submit</button>
</form> -->

// FILTER_VALIDATE- exemple
<?php
const ERROR_REQUIRED = "Veuillez renseigner ce champ";
const ERROR_LENGTH = "Le champ doit faire entre 2 et 10 caractères";
const ERROR_EMAIL = "L'email n'est pa valide";
$errors = [];
sinon dés l'arrivée sur la page on aura les champs en erreur (cad cela correpond à dés que le user aura appuyé sue le bouton submit le code se déclenchera)
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // 
  $_POST = filter_input_array(INPUT_POST, [
    'firstname' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    'email' => FILTER_SANITIZE_EMAIL,
  ]);
  $firstname = $_POST['firstname'] ?? '';
  $email = $_POST['email'] ?? '';

  if (!$firstname) {
    $errors['firstname'] = ERROR_REQUIRED;
  } elseif (mb_strlen($firstname) < 2 || mb_strlen($firstname) > 10) {
    $errors['firstname'] = ERROR_LENGTH;
  }
  if (!$email) {
    $errors['email'] = ERROR_REQUIRED;
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = ERROR_EMAIL;
  }
}
?>


<form action="" method="POST">
  <div>
    <label for="firstname">Prénom</label><br>
    <input type="text" name="firstname" id="firstname">
    <?= $errors['firstname'] ? '<p style="color:red">' . $errors['firstname'] . '</p>' : "" ?>
  </div>
  <div>
    <label for="email">Email</label><br>
    <input type="email" name="email" id="email">
    <?= $errors['email'] ? '<p style="color:red">' . $errors['email'] . '</p>' : "" ?>
  </div>
  <button type="submit">Submit</button>
</form>

// préserver les valeurs rentrées pas l'utilisateur
// ajout d'une valeur par défaut à value 

<?php
const ERROR_REQUIRED = "Veuillez renseigner ce champ";
const ERROR_LENGTH = "Le champ doit faire entre 2 et 10 caractères";
const ERROR_EMAIL = "L'email n'est pa valide";
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $_POST = filter_input_array(INPUT_POST, [
    'firstname' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    'email' => FILTER_SANITIZE_EMAIL,
  ]);
  $firstname = $_POST['firstname'] ?? '';
  $email = $_POST['email'] ?? '';

  if (!$firstname) {
    $errors['firstname'] = ERROR_REQUIRED;
  } elseif (mb_strlen($firstname) < 2 || mb_strlen($firstname) > 10) {
    $errors['firstname'] = ERROR_LENGTH;
  }
  if (!$email) {
    $errors['email'] = ERROR_REQUIRED;
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = ERROR_EMAIL;
  }
}
?>


<form action="" method="POST">
  <div>
    <label for="firstname">Prénom</label><br>
    <input type="text" name="firstname" id="firstname" value=<?= $firstname ?? '' ?>>
    <?= $errors['firstname'] ? '<p style="color:red">' . $errors['firstname'] . '</p>' : "" ?>
  </div>
  <div>
    <label for="email">Email</label><br>
    <input type="email" name="email" id="email" value=<?= $email ?? '' ?>>
    <?= $errors['email'] ? '<p style="color:red">' . $errors['email'] . '</p>' : "" ?>
  </div>
  <button type="submit">Submit</button>
</form>