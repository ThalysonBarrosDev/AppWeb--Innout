<?php

    $errors = [];

    if ($exception) {

        $message = ['type' => 'error', 'message' => $exception->getMessage()];

        if (get_class($exception) === 'ValidationException') {

            $errors = $exception->getErrors();

        }

    }

    $alerttype = '';

    if ($message['type'] === 'error') {

        $alerttype = 'danger';

    } else {

        $alerttype = 'success';

    }

?>

<?php if ($message): ?>

    <div class="my-3 alert alert-<?= $alerttype; ?> text-center" role="alert">
        <?= $message['message']; ?>
    </div>

<?php endif; ?>