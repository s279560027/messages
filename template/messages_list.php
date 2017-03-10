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
                    <a class="btn btn-success" href="/view?message_id=<?= $message['id'] ?>">Просмотреть</a>
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
