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

                    <?php if (empty($message['approve'])): ?>
                        <a class="btn btn-success" href="?action=approve&message_id=<?= $message['id'] ?>&approve=1">Одобрить</a>
                    <?php else: ?>
                        <a class="btn btn-warning" href="?action=approve&message_id=<?= $message['id'] ?>&approve=0">Отклонить</a>
                    <?php endif; ?>

                    <a class="btn btn-danger" href="?action=delete&message_id=<?= $message['id'] ?>">Удалить</a>

                </td>
            </tr>

        <?php endforeach; ?>
    </table>
<?php endif; ?>
