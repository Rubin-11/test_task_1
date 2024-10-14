<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Комментарии</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container mt-5">
        <h1 class="mb-4">Комментарии</h1>

        <div id="comments" class="mb-4">
            <?php foreach ($comments as $comment): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($comment['name']); ?> (<?= esc($comment['date']); ?>)</h5>
                        <p class="card-text"><?= esc($comment['text']); ?></p>
                        <button class="btn btn-danger" onclick="deleteComment(<?= $comment['id']; ?>)">Удалить</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Пагинация -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= site_url('comments/index' . ($page - 1)); ?>">Назад</a>
                    </li>
                <?php endif; ?>

                <li class="page-item disabled">
                    <span class="page-link">Страница <?= $page; ?> из <?= ceil($total / $perPage); ?></span>
                </li>

                <?php if ($page < ceil($total / $perPage)): ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= site_url('comments/index' . ($page + 1)); ?>">Вперед</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

        <div class="form-group">
            <label for="sort">Сортировать по:</label>
            <select id="sort" class="form-control" onchange="sortComments(this.value)">
                <option value="date_desc" <?= $sort === 'date_desc' ? 'selected' : ''; ?>>По дате (новые сначала)</option>
                <option value="date_asc" <?= $sort === 'date_asc' ? 'selected' : ''; ?>>По дате (старые сначала)</option>
                <option value="name_asc" <?= $sort === 'name_asc' ? 'selected' : ''; ?>>По имени (A-Z)</option>
                <option value="name_desc" <?= $sort === 'name_desc' ? 'selected' : ''; ?>>По имени (Z-A)</option>
            </select>
        </div>

        <h2 class="mt-5">Добавить комментарий</h2>
        <form id="commentForm" class="mt-3">
            <div class="form-group">
                <input type="email" name="name" class="form-control" placeholder="Ваш email" required>
            </div>
            <div class="form-group">
                <textarea name="text" class="form-control" placeholder="Ваш комментарий" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>
    </div>

   
    <script src="<?= base_url("js/script.js") ?>"></script>
    <script>
        function sortComments(order) {
            const page = <?= $page; ?>; // Текущая страница
            window.location.href = '<?= site_url('comments/index'); ?>' + page + '?sort=' + order;
        }
    </script>
</body>

</html>