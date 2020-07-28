<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Phone</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-10">
            Total Number: <?= $totalCount['total_count']?><br>
            More Code Number: <?= $moreCountryCount['code']?> | <?= $moreCountryCount['count']?><br>
            Less Code Number: <?= $lessCountryCount['code']?> | <?= $lessCountryCount['count']?><br>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Numbers</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($countryCodeWithNumbers as $item) :?>
                <tr>
                    <td><?= $item['code']?></td>
                    <td><?= $item['numbers']?></td>
                </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            <a href="/report" class="btn btn-primary">Get Repost</a>
        </div>
    </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

</html>