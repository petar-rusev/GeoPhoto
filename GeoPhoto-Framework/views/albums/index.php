<h1><?= htmlspecialchars($this->title)?></h1>
<table>
    <tr>
        <th>Id</th>
        <th>name</th>
    </tr>
    <?php foreach ($this->albums as $album) : ?>
        <tr>
            <td><?= htmlspecialchars($album['id'])?></td>
            <td><?= htmlspecialchars($album['name'])?></td>
        </tr>
    <?php endforeach ?>
</table>
Hello, I am the Index view.