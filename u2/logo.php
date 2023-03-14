<?php
// defined('ENTER') || die('no entry');
if(isset($_SESSION['msg'])) {
    $msg = $_SESSION['msg']['txt'];
    $msg_col = match($_SESSION['msg']['type']) {
        'error' => 'red',
        'ok' => 'blue', 
        'default' => 'black'
    };
    unset($_SESSION['msg']);
};

?>
<div class="d-flex flex-column justify-content-center mt-5">
    <h2 style="margin-left: 100px;"> 
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-bank"           viewBox="0 0 16 16">
        <path d="m8 0 6.61 3h.89a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v7a.5.5 0 0 1 .485.38l.5 2a.498.498 0 0 1-.485.62H.5a.498.498 0 0 1-.485-.62l.5-2A.501.501 0 0 1 1 13V6H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 3h.89L8 0ZM3.777 3h8.447L8 1 3.777 3ZM2 6v7h1V6H2Zm2 0v7h2.5V6H4Zm3.5 0v7h1V6h-1Zm2 0v7H12V6H9.5ZM13 6v7h1V6h-1Zm2-1V4H1v1h14Zm-.39 9H1.39l-.25 1h13.72l-.25-1Z"/>
        </svg> 
        Trijų kortų bankelis 
    </h2>
    <div class="ml-4" style="margin-left: 100px">
    <p style="color: <?= $msg_col ?>"><?= $msg ?></p>
    </div>
    <div class="ml-4" style="margin-left: 100px">
    <?php if($menu_login) : ?>
    <a type="button" class="btn btn-outline-warning" href="http://localhost/phpbootstrap/u2/login/">Login</a>
    <?php endif ?>
    <?php if($menu_home) : ?>
    <a type="button" class="btn btn-outline-warning" href="http://localhost/phpbootstrap/u2/">Pradinis puslapis</a>
    <?php endif ?>
    <?php if($menu_new_acc) : ?>
    <a type="button" class="btn btn-outline-warning" href="http://localhost/phpbootstrap/u2/bin/naujas.php">Sukurti naują sąskaitą</a>
    <?php endif ?>
    <?php if($menu_acc_list) : ?>
    <a type="button" class="btn btn-outline-warning" href="http://localhost/phpbootstrap/u2/bin/sarasas.php">Eiti į sąskaitų sąrašą</a>
    <?php endif ?>
    </div>
</div>
