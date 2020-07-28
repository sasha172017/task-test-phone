<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Phone</title>
    <link rel="stylesheet" type="text/css" href="<?= '/../../asset/bootstrap.css' ?>">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-10">
            <?php if ($errors): ?>
                <?php foreach ($errors as $field => $error): ?>
                <br><br>
                    <div class="alert alert-danger" role="alert">
                        <?= $field ?>
                        <ul>
                            <?php foreach ($error as $er): ?>
                                <li><?= $er ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; endif; ?>
            <form method="POST">
                <div class="form-group" id="codeCountry">
                    <label for="selectCode">Code Country:</label>
                    <select name="code[]" class="form-control" id="selectCode">
                        <?php foreach ($codes as $id => $code): ?>
                            <option value="<?= $id ?>"><?= $code['value'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div id="codeCountryAdd">
                </div>
                <button type="button" id="add" onclick="add()" class="btn btn-primary">Add</button>

                <div class="form-group">
                    <label for="int">Count:</label>
                    <input name="count" type="int" class="form-control" id="int">
                </div>
                <button type="submit" class="btn btn-primary">Generate</button>
            </form>
            <br>
        </div>
    </div>
</div>
</body>

<script type="text/javascript">
    document.getElementById('add').onclick = add;

    function add() {
        var itm = document.getElementById("codeCountry");
        var cln = itm.cloneNode(true);
        document.getElementById("codeCountryAdd").appendChild(cln);
    }
</script>

</html>