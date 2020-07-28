
<table border="1">
    <thead>
    <tr>
        <th scope="col">Code</th>
        <th scope="col">Numbers</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($numbersExplode as $code => $item) :?>
        <tr>
            <td><?= $code?></td>
            <?php foreach ($item[0] as $number) :?>
            <td><?= $number?></td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach;?>
    <tr>
        <td>Total Number: </td><td><?= $totalCount['total_count']?></td>
    </tr>
    <tr>
        <td>More Code Number: </td><td> <?= $moreCountryCount['code']?> | <?= $moreCountryCount['count']?></td>
    </tr>
    <tr>
        <td>Less Code Number: </td><td><?= $lessCountryCount['code']?> | <?= $lessCountryCount['count']?></td>
    </tr>
    </tbody>
</table>