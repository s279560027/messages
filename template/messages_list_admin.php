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
                <td><?= htmlspecialchars($message['name']); ?></td>
                <td><?= htmlspecialchars($message['email']); ?></td>
                <td><?= htmlspecialchars($message['header']); ?></td>
                <td><?= htmlspecialchars(mb_strimwidth($message['text'], 0, 20, '...', 'utf-8')); ?></td>
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
<?php else: ?>
    <table class="table">
        <tr>
            <td>Сообщений нет</td>
        </tr>
    </table>

<?php endif; ?>
