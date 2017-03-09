<?php
$messages = $variables['messages'];
if (!empty($messages)): ?>
    <table class="table">
        <tr>
            <th>Имя</th>
            <th>Email</th>
            <th>Заголовок</th>
            <th>Текст</th>
            <th>Действия</th>
        </tr>
        <?php foreach ($messages as $message): ?>
            <tr>
                <td><?= $message['name'] ?></td>
                <td><?= $message['email'] ?></td>
                <td><?= $message['header'] ?></td>
                <td><?= $message['text'] ?></td>
                <td>
                    <a class="btn btn-success" href="/view?message_id=<?= $message['id'] ?>">Просмотреть</a>
                </td>
            </tr>

        <?php endforeach; ?>
    </table>
<?php endif; ?>
